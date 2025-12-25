<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];
}
