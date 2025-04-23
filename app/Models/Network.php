<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $fillable = [
        'child',
        'mother',
        'join_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'child', 'id');
    }

    public function motherUser()
    {
        return $this->belongsTo(User::class, 'mother', 'id');
    }
}
