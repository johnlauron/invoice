<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'doc_name'
    ];

    protected $table = 'documents';
}
