<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Role-User pivot model.
 *
 * Represents the many-to-many relationship between users and roles.
 * Uses composite primary key (role_id, user_id).
 *
 * @property int $role_id
 * @property int $user_id
 */
class RoleUser extends Model
{
    /** @var bool Disable auto-incrementing IDs */
    public $incrementing = false;

    /** @var array<int> Composite primary key */
    protected $primaryKey = ['role_id', 'user_id'];

    /** @var string Key type */
    protected $keyType = 'int';

    /** @var bool Disable timestamps (pivot table) */
    public $timestamps = false;

    /**
     * Get the role for this pivot entry.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the user for this pivot entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
