<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $guarded = [];
	protected $table = 'ministries';

	public function convention(){
        return $this->belongsTo(Convention::class);
    }
}
