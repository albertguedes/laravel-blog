<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User model for authentication and authorization.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'is_active',
        'is_admin',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $cast = [
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the user's profile.
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the user's posts.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /**
     * Get the route key name for URL resolution.
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /**
     * Get the user's roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->withPivot('created_at');
    }

    /**
     * Check if the user's email is verified.
     */
    public function isEmailVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    /**
     * Get the user's verification token.
     */
    public function verificationToken(): HasOne
    {
        return $this->hasOne(VerificationToken::class, 'email', 'email');
    }

    /**
     * Resolve route binding using username.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     */
    public function resolveRouteBinding($value, $field = null): User
    {
        return static::whereHas('profile', function ($query) use ($value) {
            $query->where('username', $value);
        })->firstOrFail();
    }
}
