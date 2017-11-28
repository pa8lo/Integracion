<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\Folder;
use App\User;
use App\Notification;
use Auth;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

class FilesController extends Controller
{

    public function index()
    {
        $usuarios = User::all();
        return view('User/showfiles')->with('users', $usuarios);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        if($request->file){
            $nombre = $request->file->getClientOriginalName();
            if (Storage::exists( 'public/files/'.Auth::user()->id.'/'.'Home'.'/'.$nombre,
                file_get_contents($request->file('file')->getRealPath())))
            {   
               return back()->with('nombre', $nombre);
               exit();
           }
           Storage::put(
            'public/files/'.Auth::user()->id.'/'.'Home'.'/'. $nombre,
            file_get_contents($request->file('file')->getRealPath())
            );

           $archivo = new Record();
           $archivo->name = $nombre;
           $archivo->user_id = Auth::user()->id;

           if(is_null($request->is_public)){
            $archivo->is_public = "no";
        }else{
            $archivo->is_public = $request->is_public;
        }

        $archivo->save();

        $folder = Folder::where('user_id', Auth::user()->id)->first();
        $archivo->folders()->attach($folder->id);

    }

        //$archivo->users()->sync(Auth::user()->id); //Sync se utiliza como attach para relacionar tabla pivote

    return redirect()->action('FilesController@index');
}

public function show($id)
{
    return view('User.showfiles')->with('id_folder', $id);
}

public function edit($id)
{
        //
}

public function update(Request $request, $id)
{

    $author_record = Record::findOrFail($id);
    $author;

    foreach ($author_record->user()->get() as $role) {
       $author = $role->id;
   }

   if($author == Auth::user()->id){

    //Accion ante el cambio de nombre del archivo
    if($request->oldname != "" && $request->oldname != null){

        $archivo = Record::findOrFail($id);

        if(is_null($request->name)){
            $archivo->name = $archivo->name;
        }else{
            $archivo->name = $request->name;
        }if (Storage::exists( 'public/files/'.Auth::user()->id.'/'.$request->name)){
            return view('User/showfiles')->with('nombre', $archivo);
        }else{
            Storage::move('public/files/'.Auth::user()->id.'/'.$request->oldname, 'public/files/'.Auth::user()->id.'/'.$request->name);
            $archivo->save();
        }

    //Accion ante mover el archivo hacia otra carpeta y actualizar tabla pivote
    }else{

        $archivo = Record::findOrFail($id);
        $id_folder = Folder::findOrFail($request->folder_id);

        foreach ($archivo->folders as $role) {

            if($archivo->id == $role->pivot->record_id){

                $name_folder_from = Folder::findOrFail($role->pivot->folder_id);
                $name_folder_from = $name_folder_from->name;

                if($archivo->id == $role->pivot->record_id){

                    DB::table('folder_record')
                    ->where('record_id',$archivo->id)
                    ->update([
                        "folder_id" => $id_folder->id,
                        ]);

                    if(Storage::exists( 'public/files/'.Auth::user()->id.'/'.$id_folder->name.'/'.$archivo->name)){
                        return view('User/showfiles')->with('nombre', $archivo); 
                    }else{
                        Storage::move('public/files/'.Auth::user()->id.'/'.$name_folder_from.'/'.$archivo->name, 'public/files/'.Auth::user()->id.'/'.$id_folder->name.'/'.$archivo->name);
                    }

                }
            }
        }
        return redirect()->action('FilesController@index');  
    }

}else{
    return view('User.showfiles')->with('validation', $author);
}
}

public function destroy($id)
{
    $rec = Record::findOrFail($id);

    foreach ($rec->folders as $folder) {

        if($folder->id == 1){
            Storage::delete('public/files/'.Auth::user()->id.'/'.$rec->name);
            $rec->delete();

        }else if($folder->id != 1){
            Storage::delete('public/files/'.Auth::user()->id.'/'.$folder->name.'/'.$rec->name);
            $rec->delete();
        }

    }

    return redirect()->action('FilesController@index');
}
public function mostrarArchivos(Request $request)
{
    
    
    $users = DB::table('records')
                        ->join('users', 'records.user_id', '=', 'users.id')     
                        ->select('users.name as nombre_del_propietario',
                        'records.name as nombre_del_archivo','records.user_id as ubicacion_del_archivo') 
                        ->where('records.name','like','%'.$request->name.'%')
                        ->get();
                        
//    var_dump($users);
    //json_decode($users);
   // var_dump($users);
    // $users = DB::table('records')
    // ->join('users', 'records.user_id', '=', 'users.id')                      
    // ->select('users.name')
    // ->select('records.name')
    // ->get();                            
    //json_encode($users);
    // return $users;
   /// json_decode($users);
    //$users['ubicacion_del_archivo'] = "asdñalsdk";
    //$id_usuario = $users['ubicacion_del_archivo'];
    //json_encode($users);
    //var_dump ($users);
    //echo $users[0]['ubicacion_del_archivo'];
    //var_dump($users);
    //echo $users;
    
   // echo $users;                            
   foreach ($users as $name => $user) {
        $user ->ubicacion_del_archivo =  "storage/files/"
        .$user ->ubicacion_del_archivo
        ."/" 
        .$user->nombre_del_archivo;
     }
     return $users;
    //return view('User/showfiles');
}

/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */


}
