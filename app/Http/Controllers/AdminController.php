<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ProgressOrder;
use View;

class AdminController extends Controller
{
    public function viewDashBoad()
    {
    	View::share('thispagename', 'Dashboard');

    	$today = date('Y-m-d');

    	$allUser = (new User())->checkTodayProgress($today);

    	return view('dashboard')->with(['allUser' => $allUser]);
    }

    public function viewConfigure()
    {
    	View::share('thispagename', 'Configure');

    	$allUser = (new User())->getAllUserBasedOnOrder();

    	return view('configuration')->with(['allUser' => $allUser]);
    }

    public function saveConfigure(Request $request)
    {
    	return (new ProgressOrder())->updateOrder($request->all());
    }
}
