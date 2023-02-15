<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use HasFactory;

    protected $fillable = [
        'is_active',
        'title',
        'slug',
        'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
    * Scope a query to only include active tags.
    * https://www.scratchcode.io
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeIsActive($query)
    {
        return $query->where('is_active', '=', true);
    }

}
