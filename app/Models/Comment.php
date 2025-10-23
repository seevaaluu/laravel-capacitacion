<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $casts = [
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'metadata' => 'json',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
