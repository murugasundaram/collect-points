<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Mail\MyTestMail;
use View;
use Mail;

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

    /**
    * This function used to 
    *
    * @author Muruga
    * @date 
    */
    public function managePassword()
    {
    	View::share('thispagename', 'Manage Password');

    	$allUser = (new User())->getAllUsers();

    	return view('passwordManage', ['users' => $allUser]);
    }

    /**
    * This function used to 
    *
    * @author Muruga
    * @date 
    */
    public function saveManagePassword(Request $request)
    {
    	$data = $request->all();

    	User::where('id', $data['_userDrop'])->update(['password' => Hash::make($data['_pass'])]);
    	$user = User::find($data['_userDrop']);

    	$details = [
	        'url' => url('login'),
	        'name' => $user->nick_name,
	        'password' => $data['_pass']
	    ];
	   	
	   	if($data['_notifyUser'] == 'true') {
	    	Mail::to($user->email)->send(new MyTestMail($details));
	   	}

    	return [
    		'error' => false,
    		'msg' => 'Password has been updated for the <strong>'.$user->nick_name.'</strong>.'
    	];
    }
}
