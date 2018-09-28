<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filename extends Model
{
    protected $fillable = [
        'company_id','file_name','file_location','form_name_id','select','file','doc_id','parse'
    ];

    protected $table = 'files';
}
