<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\VerificationTokenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model for verification tokens (email verification and password reset).
 *
 * @file
 *
 * @author Albert
 *
 * @since 1.0.0
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property Carbon $expires_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see VerificationTokenFactory
 * @see User
 */
class VerificationToken extends Model
{
    /** @use HasFactory<VerificationTokenFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    /**
     * Get the user associated with this verification token.
     *
     * Links via email field instead of user_id for password reset flexibility.
     *
     * @return BelongsTo<User, VerificationToken>
     *
     * @since 1.0.0
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Check if the verification token has expired.
     *
     * Compares current time against the expires_at timestamp.
     *
     * @return bool True if token is expired, false otherwise
     *
     * @since 1.0.0
     *
     * @example
     * if ($token->isExpired()) {
     *     // Handle expired token
     * }
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }
}
