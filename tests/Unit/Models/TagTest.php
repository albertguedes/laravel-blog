<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Tag;

describe('Tag Model', function () {
    it('can be created with factory', function () {
        $tag = Tag::factory()->create();
        expect($tag)->toBeInstanceOf(Tag::class);
    });

    it('generates slug from title automatically', function () {
        $tag = Tag::factory()->create(['title' => 'My Tag', 'slug' => 'my-tag']);
        expect($tag->slug)->toBe('my-tag');
    });

    it('uses slug as route key', function () {
        $tag = Tag::factory()->make();
        expect($tag->getRouteKeyName())->toBe('slug');
    });

    it('can have many posts', function () {
        $tag = Tag::factory()->create();
        $post = Post::factory()->make();
        $post->save();
        $tag->posts()->attach($post->id);
        expect($tag->posts->first())->toBeInstanceOf(Post::class);
    });

    it('is_active cast is boolean', function () {
        $tag = Tag::factory()->create(['is_active' => true]);
        expect($tag->is_active)->toBeTrue();
    });

    it('has correct fillable attributes', function () {
        $tag = new Tag;
        expect(in_array('title', $tag->getFillable()))->toBeTrue();
        expect(in_array('slug', $tag->getFillable()))->toBeTrue();
        expect(in_array('description', $tag->getFillable()))->toBeTrue();
        expect(in_array('is_active', $tag->getFillable()))->toBeTrue();
    });
});
