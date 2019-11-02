<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $guarded = [];
	protected $table = 'reserves';

	public function convention(){
        return $this->belongsTo(Convention::class);
    }

    public function salon(){
        return $this->belongsTo(Salon::class);
    }
}
