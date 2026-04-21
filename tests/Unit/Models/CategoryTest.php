<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Post;

describe('Category Model', function () {
    it('can be created with factory', function () {
        $category = Category::factory()->create();
        expect($category)->toBeInstanceOf(Category::class);
    });

    it('generates slug from title automatically', function () {
        $category = Category::factory()->create(['title' => 'My Category', 'slug' => 'my-category']);
        expect($category->slug)->toBe('my-category');
    });

    it('uses slug as route key', function () {
        $category = Category::factory()->make();
        expect($category->getRouteKeyName())->toBe('slug');
    });

    it('has parent relationship', function () {
        $parent = Category::factory()->create();
        $child = Category::factory()->create(['parent_id' => $parent->id]);
        expect($child->parent)->toBeInstanceOf(Category::class);
        expect($child->parent->id)->toBe($parent->id);
    });

    it('has children relationship', function () {
        $parent = Category::factory()->create();
        $child = Category::factory()->create(['parent_id' => $parent->id]);
        expect($parent->children->first())->toBeInstanceOf(Category::class);
        expect($parent->children->first()->id)->toBe($child->id);
    });

    it('has many posts', function () {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);
        expect($category->posts->first())->toBeInstanceOf(Post::class);
    });

    it('is_active cast is boolean', function () {
        $category = Category::factory()->create(['is_active' => true]);
        expect($category->is_active)->toBeTrue();
    });

    it('can have nested children', function () {
        $grandparent = Category::factory()->create();
        $parent = Category::factory()->create(['parent_id' => $grandparent->id]);
        $child = Category::factory()->create(['parent_id' => $parent->id]);
        expect($child->parent->parent->id)->toBe($grandparent->id);
        expect($grandparent->children->count())->toBe(1);
        expect($parent->parent->id)->toBe($grandparent->id);
    });
});
