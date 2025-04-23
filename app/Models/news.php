<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $fillable = [
        'thumbnail',
        'title',
        'content',
        'author',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
