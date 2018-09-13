<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
	protected $fillable = [
        'file_id','formname_id','value'
    ];
    protected $table = 'form_data';
}
