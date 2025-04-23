<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'status',
        'from_user',
        'noted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userFrom()
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }
}
