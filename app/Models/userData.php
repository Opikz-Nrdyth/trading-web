<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userData extends Model
{
    use HasFactory;
    protected $fillable = [
        'referals',
        'profile_image',
        'username',
        'address',
        'country',
        'phone_number',
        'bitcoin_address',
        'bank_number',
        'type_currency',
        'bank_name',
        'members',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function userCurrency()
    {
        return $this->belongsTo(currency::class);
    }

    public function userReferals()
    {
        return $this->belongsTo(User::class, 'referals', 'id');
    }
}
