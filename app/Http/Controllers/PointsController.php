<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Points;
use App\User;
use App\SupportTickets;
use AUth;

class PointsController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
    	
        $where = [
    		'user_id' => Auth::user()->id,
    		'as_on_date' => $today
    	];

    	$points = (new Points())->getMyPoint($where);
        $st = (new SupportTickets())->getMyPointOrSupport(['support_or_point' => 1, 'as_on_date' => $today]);

    	return view('points.user')->with(['points' => $points, 'st' => $st]);
    }

    public function updatePoints(Request $request)
    {
        if(isset($request->progress)) {
            $data = [
        		'user_id' => Auth::user()->id,
        		'nick_name' => Auth::user()->nick_name,
        		'points' => $request->progress,
        		'as_on_date' => date('Y-m-d')
        	];

        	$update = (new Points())->doFirstOrNew($data);
        }

        // check support tkt or points
        if(isset($request->supportTkt)) {
            $data = [
                'support_or_point' => 1, // 1 means support tkt
                'points' => $request->supportTkt,
                'as_on_date' => date('Y-m-d')
            ];

            $update = (new SupportTickets())->doFirstOrNew($data);
        }

        // check support tkt or points
        if(isset($request->lastMinPoints)) {
            $data = [
                'support_or_point' => 2, // 2 means last min points
                'points' => $request->lastMinPoints,
                'as_on_date' => date('Y-m-d')
            ];

            $update = (new SupportTickets())->doFirstOrNew($data);
        }

    	return redirect()->back()->withSuccess('Your Progress has been submitted successfully!');
    }

    public function viewProgress()
    {
        $today = date('Y-m-d');

        $progress = (new User())->getAllProgress($today);
        $st = (new SupportTickets())->getMyPointOrSupport(['support_or_point' => 1, 'as_on_date' => $today]);

        return view('progress')->with(['progress' => $progress, 'st' => $st]);
    }
}
