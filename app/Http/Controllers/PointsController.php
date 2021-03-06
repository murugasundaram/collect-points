<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Points;
use App\User;
use App\SupportTickets;
use AUth;

class PointsController extends Controller
{
    protected $daysOfWeek = [
        'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
    ];

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
        $today = date('Y-m-d');

        if(isset($request->progress)) {
            $data = [
        		'user_id' => Auth::user()->id,
        		'nick_name' => Auth::user()->nick_name,
        		'points' => $request->progress,
        		'as_on_date' => $today
        	];

        	$update = (new Points())->doFirstOrNew($data);
        }

        // check support tkt or points
        if(Auth::user()->is_support_admin) {
            if(isset($request->supportTkt)) {
                $data = [
                    'support_or_point' => 1, // 1 means support tkt
                    'points' => $request->supportTkt,
                    'as_on_date' => $today
                ];

                $update = (new SupportTickets())->doFirstOrNew($data);
            } else {
                (new SupportTickets())->deleteIfExist($today);
            }
        }

    	return redirect()->back()->withSuccess('Your Progress has been submitted successfully!');
    }

    public function viewProgress()
    {
        $today = date('Y-m-d');
        $dateIssue = false;

        if(isset($_GET['date'])) {
            $dateIssue = true;
            $checkValidDate = $this->isValidDate($_GET['date']);
            if($checkValidDate){
                $dateIssue = false;
                $today = $_GET['date'];
            }
        }

        $progress = (new User())->getAllProgress($today);
        $st = (new SupportTickets())->getMyPointOrSupport(['support_or_point' => 1, 'as_on_date' => $today]);
        $day = date('w', strtotime($today));

        $dates = [
            'progress' => $today,
            'today' => date('Y-m-d'),
            'prev' => date('Y-m-d', strtotime($today.' -1 day')),
            'next' => date('Y-m-d', strtotime($today.' +1 day')),
            'day' => $this->daysOfWeek[$day],
            'isHoliday' => ($day == 6 || $day == 0) ? true : false
        ];

        return view('progress')->with(['progress' => $progress, 'st' => $st, 'dates' => $dates]);
    }

    public function isValidDate($date, $format= 'Y-m-d'){
        return $date == date($format, strtotime($date));
    }

    public function viewHistory()
    {
        $data = [
            'user_id' => Auth::user()->id,
            'as_on_date' => [
                date('Y-m-d', strtotime('-10 days')),
                date('Y-m-d'),
            ]
        ];

        $history = (new Points())->getPointsHistory($data);

        return view('history')->with(['history' => $history]);
    }
}
