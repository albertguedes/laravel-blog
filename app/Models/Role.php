<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Role model for user authorization roles.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];

    protected $cast = [
        'title' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
    ];

    /**
     * Get the users with this role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('created_at');
    }
}
