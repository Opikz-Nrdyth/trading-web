<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package',
        'amount',
        'status',
        'invoice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
