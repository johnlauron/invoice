<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceInput extends Model
{
	protected $fillable = [
        'height','width','xloc','yloc','file_id','form_name_id','category_name','company_id','section'
    ];
    protected $table = 'invoice_input';
}
