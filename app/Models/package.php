<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan',
        'min_amount',
        'max_amount',
        'min_contract',
        'max_contract',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trade()
    {
        return $this->hasMany(trade::class, 'trade_id', 'id');
    }
}
