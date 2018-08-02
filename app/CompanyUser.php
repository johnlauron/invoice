<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $fillable = [
        'user_id', 'company_id'
    ];

    protected $table = 'companyusers';
}
