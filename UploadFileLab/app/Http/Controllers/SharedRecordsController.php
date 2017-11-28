<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\User;
use Auth;
use File;

class SharedRecordsController extends Controller
{

	public function show(){
		return view('User/sharedwith');
	}

    public function create(Request $request){

    	$archivo = Record::findOrFail($request->id_record);
    	$shared_with = User::where('name', $request->user_name)->first();

        $archivo->sharedWith()->attach($shared_with->id);

		return redirect()->action('SharedRecordsController@show');
	}
}
