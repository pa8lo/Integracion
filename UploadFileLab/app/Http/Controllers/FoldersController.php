<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Record;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $result = File::makeDirectory ('storage/files/'.Auth::user()->id.'/'.$request->folder_name, 0777, true, true);

        $hashmd5 = md5($request->folder_name);
        $archivo = new Folder();
        $archivo->name = $request->folder_name;
        $archivo->folder_hash = $hashmd5;
        $archivo->user_id = Auth::user()->id;
        $archivo->save();

        return redirect()->action('FilesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = Folder::findOrFail($id);
        
        if($folder->id == "Home"){
            return view('User.showfiles');
        }else{
            return view('User.folder')->with('id_folder', $id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);

        Storage::move('public/files/'.Auth::user()->id.'/'.$folder->name, 'public/files/'.Auth::user()->id.'/'.$request->name);
        $folder->name = $request->name;
        $folder->folder_hash = md5($request->name);
        $folder->save();
        return view('User.showfiles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $id_folder = Folder::findOrFail($id);

        if($id_folder->id == 1){
            return view('User.showfiles');
        }else{
                foreach ($id_folder->files as $file) {
                    $file->delete();
                }
                Storage::deleteDirectory('public/files/'.Auth::user()->id.'/'.$id_folder->name);
                $id_folder->delete();
                return view('User.showfiles')->with("rtaFolder", $id_folder);
        }
    }
}
