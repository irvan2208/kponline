<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    //protected $dates = ['deleted_at'];
	protected $table = 'transaction';
	public $timestamps = true;
}
