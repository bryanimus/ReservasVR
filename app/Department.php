<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   	protected $guarded = [];
	protected $table = 'departments';

	public function convention(){
        return $this->belongsTo(Convention::class);
    }
}
