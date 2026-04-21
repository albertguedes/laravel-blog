<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\VerificationTokenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationToken extends Model
{
    /** @use HasFactory<VerificationTokenFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    /**
     * Checks if the verification token has expired.
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }
}
