<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class WebService extends Controller
{
    
	public function first()
    {
    	$user = User::all();
        return $user; 
    }

}
