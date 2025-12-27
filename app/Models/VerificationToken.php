<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationToken extends Model
{
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
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }
}
