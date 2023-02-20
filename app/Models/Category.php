<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'is_active',
        'title',
        'slug',
        'description'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id')->with('children')->orderBy('title');
    }

    public function posts( $published = false ){

        $query = $this->hasMany(Post::class);
        $query->orderBy('title');
        if ($published) {
            $query->where('published', true);
        }

        return $query->get();

    }

    /**
    * Scope a query to only include active posts.
    * https://www.scratchcode.io
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeIsActive($query)
    {
        return $query->where('is_active', '=', true);
    }

}
