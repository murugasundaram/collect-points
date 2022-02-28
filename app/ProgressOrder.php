<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressOrder extends Model
{
    protected $guarded = ['updated_at'];

    public function updateOrder($data)
    {
    	foreach ($data['data'] as $key => $value) {
    		$user = $this::firstOrNew(['user_id' => $value]);
    		$user->order = $key + 1;
    		$user->save();
    	}

    	return [
    		'error' => false
    	];
    }
}
