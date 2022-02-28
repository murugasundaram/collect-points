<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nick_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkTodayProgress($today)
    {
        return $this::select('users.nick_name', 'points.id as exist_id')
                ->leftjoin('points', function($join) use ($today) {
                    $join->on('users.id', '=', 'points.user_id')
                        ->where('points.as_on_date', $today);
                })->get();   
    }

    public function getAllUserBasedOnOrder()
    {
        return $this::select('users.*', 'progress_orders.order')
                ->leftjoin('progress_orders', function($join) {
                    $join->on('users.id', '=', 'progress_orders.user_id');
                })->orderBy('progress_orders.order', 'asc')->get();
    }

    public function getAllProgress($today)
    {
        return $this::select('users.nick_name', 'points.points', 'points.as_on_date')
                ->leftjoin('points', function($join) use ($today) {
                    $join->on('users.id', '=', 'points.user_id')
                        ->where('points.as_on_date', $today);
                })
                ->leftjoin('progress_orders', function($join) {
                    $join->on('users.id', '=', 'progress_orders.user_id');
                })
                ->orderBy('progress_orders.order', 'asc')
                ->get();
    }
}
