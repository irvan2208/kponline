<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class sys extends Model
{
	use SoftDeletes;
	protected $primaryKey = 'no_polis';
	public $incrementing = false;
	protected $dates = ['deleted_at'];
	protected $table = 'sys';
    //public $timestamps = false; // kolom created_at updated_add tidak ada

    //protected $fillable = ['title','description']; //whitelist
    // protected $guarded = ['title','description']; //blacklist

}
