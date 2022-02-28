<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTickets extends Model
{
    protected $guarded = ['updated_at'];

    public function getMyPointOrSupport($where)
    {
    	return $this::where($where)->pluck('points')->first();
    }

    public function doFirstOrNew($data)
    {
    	$progress = $this::firstOrNew(['support_or_point' => $data['support_or_point'], 'as_on_date' => $data['as_on_date']]);
    	$progress->points = $data['points'];
    	$progress->save();

    	return $progress;
    }
}
