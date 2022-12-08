<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class UserController extends Controller
{
    /**
    * This function used to 
    *
    * @author Muruga
    * @date 
    */
    public function index()
    {
    	View::share('thispagename', 'Users');

    	return view('users');
    }
}
