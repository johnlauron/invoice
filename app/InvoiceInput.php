<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInput extends Model
{
	protected $fillable = [
        'height','width','xloc','yloc','invoice_id','form_name_id'
    ];
    protected $table = 'invoice_input';
}
