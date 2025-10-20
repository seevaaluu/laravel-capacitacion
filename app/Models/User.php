<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use IlluminateDatabaseEloquentCastsAttribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['name_and_email'];
    protected $with = ['personal_info'];
    public function personal_info()
    {
        return $this->hasOne(Personalinfo::class, 'user_id', 'id');
    }

    public function getNameAndEmailAttribute()
    {
        return "{$this->name} y ({$this->email})";
    }

    protected function name()
    {
        return Attribute::make(
            get: fn(string $value): string => strtoupper($value),
            set: fn(string $value): string => strtolower($value)
        );
    }
}
