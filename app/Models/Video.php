<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * 
     * 
     * Tabla asociada al modelo
     */
    protected $table = 'videos';

    /**
     * 
     * 
     * Campos asignables
     */
    protected $fillable = [
        'title',
        'url',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
