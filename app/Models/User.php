<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setPasswordAttribute(string $password): void
    {
        if (! Hash::needsRehash($password)) {
            $this->attributes['password'] = $password;
        } else {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    /**
     * @return HasMany<Exercise, covariant $this>
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }

    /**
     * @return HasMany<Workout, covariant $this>
     */
    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }

    /**
     * @return HasMany<Schedule, covariant $this>
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
