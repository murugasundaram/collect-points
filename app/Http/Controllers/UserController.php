<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Projects;
use App\Mail\MyTestMail;
use View;
use Mail;

class UserController extends Controller
{
    public function index()
    {
    	View::share('thispagename', 'Users');

        $allUser = User::all();

    	return view('users', ['users' => $allUser]);
    }

    public function managePassword()
    {
    	View::share('thispagename', 'Manage Password');

    	$allUser = (new User())->getAllUsers();

    	return view('passwordManage', ['users' => $allUser]);
    }

    public function showProjects()
    {
        View::share('thispagename', 'Projects');

        $allProj = Projects::all();

        return view('projects', ['projects' => $allProj]);
    }

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

    public function saveUserInfo(Request $request)
    {
        $data = $request->all();

        $user = [];

        if($data['type'] == 'update') {
            $user = User::where('id', $data['id'])->update(['name' => $data['name'], 'nick_name' => $data['nick_name'], 'email' => $data['email']]);
        } elseif($data['type'] == 'create') { 
            $user = User::create(['name' => $data['name'], 'password' => Hash::make($data['nick_name']), 'nick_name' => $data['nick_name'], 'email' => $data['email']]);
        } elseif($data['type'] == 'delete') { 
            $user = User::where('id', $data['id'])->update(['deleted' => $data['value']]);
        }

        return $user;
    }

    public function saveProjectInfo(Request $request)
    {
        $data = $request->all();

        $user = [];

        if($data['type'] == 'update') {
            $user = Projects::where('id', $data['id'])->update(['name' => $data['name']]);
        } elseif($data['type'] == 'create') { 
            $user = Projects::create(['name' => $data['name'], 'deleted' => 0]);
        } elseif($data['type'] == 'delete') { 
            $user = Projects::where('id', $data['id'])->update(['deleted' => $data['value']]);
        }

        return $user;
    }
}
