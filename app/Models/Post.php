<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * La tabla  a la que está asociado el modelo.
     *
     * @var array<int, string>
     */
    protected $table = 'posts';

    // Campos que se pueden llenar de forma masiva (mass assignment)
    protected $fillable = [
        'title',
        'slug',
        'content',
        'author',
        'user_id '
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
