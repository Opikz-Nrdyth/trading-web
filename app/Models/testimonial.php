<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'testimonial',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
