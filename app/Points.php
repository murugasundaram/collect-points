<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $guarded = ['updated_at'];

    public function getMyPoint($where)
    {
    	return $this::where($where)->pluck('points')->first();
    }

    public function doFirstOrNew($data)
    {
    	$progress = $this::firstOrNew(['user_id' => $data['user_id'], 'as_on_date' => $data['as_on_date']]);
    	$progress->points = $data['points'];
    	$progress->nick_name = $data['nick_name'];
    	$progress->save();

    	return $progress;
    }
}
