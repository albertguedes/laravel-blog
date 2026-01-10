<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostChunk extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'content',
        'embedding',
    ];
}
