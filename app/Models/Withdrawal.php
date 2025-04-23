<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'currency_type',
        'bank_number',
        'user_bank',
        'pass_bank',
        'pin_bank',
        'amount_withdraw',
        'fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
