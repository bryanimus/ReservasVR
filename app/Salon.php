<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $guarded = [];
	protected $table = 'salones';

	public function convention(){
        return $this->belongsTo(Convention::class);
    }
}
