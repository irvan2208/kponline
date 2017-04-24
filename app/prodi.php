<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class prodi extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'prodi';
    //public $timestamps = false; // kolom created_at updated_add tidak ada

    //protected $fillable = ['title','description']; //whitelist
    // protected $guarded = ['title','description']; //blacklist
     public function users()
    {
        return $this->hasMany('App\users');
    }
}
