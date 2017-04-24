<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class users extends Model
{
	use SoftDeletes;
	protected $primaryKey = 'npm';
	//protected $dates = ['deleted_at'];
	protected $table = 'users';
    //public $timestamps = false; // kolom created_at updated_add tidak ada

    //protected $fillable = ['*']; //whitelist
    // protected $guarded = ['title','description']; //blacklist
	 public function prodi()
    {
        return $this->belongsTo('App\prodi');
    }
}
