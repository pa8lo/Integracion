<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;

class NotificationController extends Controller
{
    
	public function show(){

		$archivos = Record::all();
		return view('User.showallfiles')->with("notify",$archivos);
	}

	public function showAllFiles(){

		$record = Record::all();
		
		return view('User.filesadmin')->with('record', $record);
	}

}
