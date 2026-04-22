<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Profile model for user extended information.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class Profile extends Model
{
    /** @use HasFactory<ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'username',
        'about',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'username' => 'string',
        'about' => 'string',
    ];

    /**
     * Get the profile's user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
