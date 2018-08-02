<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'company_id','name','file_location','form_name_id','select','file'
    ];

    protected $table = 'invoices';
}
