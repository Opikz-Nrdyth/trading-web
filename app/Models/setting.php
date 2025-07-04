<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'company_name',
        'company_logo',
        'min_wd',
        'min_tf',
        'fee',
        'telegram',
        'email',
        'address',
        'phone_number'
    ];
}
