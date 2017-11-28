<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = User::orderBy('id','ASC')->paginate(8); 
        return view('Admin/User/index')->with('usuarios', $user);
    }

    public function create(){
       return view('Admin/User/create');
    }

    public function store(Request $request){
        // if($request->validate([
        // 'name'  => 'required|min:5|max:255',
        // 'email' => 'required|email|unique:users',
        // 'password'  => 'required',
        // 'type' => 'required'
        // ])){
        // $user = new User($request->all());
        // $user->password = bcrypt($request->clave);
        // $user->save();
        // return redirect()->action('UsersController@index');
        // }else{
        // return $request->validate([
        // 'name'  => 'required|min:5|max:255',
        // 'email' => 'required|email|unique:users',
        // 'password'  => 'required',
        // 'type' => 'required'
        // ]);
        // }
    }

    public function show($id){
    }
    

    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        if(is_null($request->type)){
            $user->type = $user->type;
        }else{
            $user->type = $request->type;
        }

        if(is_null($request->status)){
            $user->status = $user->status;
        }else{
            $user->status = $request->status;
        }

        if(is_null($request->space)){
            $user->space = $user->space;
        }else{
            $user->space = $request->space;
        }

        $user->save();
        return redirect()->action('UsersController@index');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->action('UsersController@index');
    }

}