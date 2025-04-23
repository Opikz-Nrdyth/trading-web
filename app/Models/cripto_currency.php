<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cripto_currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency_code',
        'currency_name',
        'currency_logo',
    ];
}
