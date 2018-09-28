<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filename extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'company_id','file_name','file_location','form_name_id','select','file','doc_id','parse'
    ];

    protected $table = 'files';
    protected $dates = ['deleted_at'];
}
