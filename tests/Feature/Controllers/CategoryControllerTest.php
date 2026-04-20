<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Category;

describe('CategoryController', function () {
    it('index page returns successful response', function () {
        $response = $this->get(route('categories'));
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
    });

    it('show page returns successful response for active category', function () {
        $category = Category::factory()->create(['is_active' => true]);
        $response = $this->get(route('category', $category->slug));
        $response->assertStatus(200);
        $response->assertViewIs('categories.show');
    });

    it('show page returns 404 for non-existent category', function () {
        $response = $this->get(route('category', 'non-existent'));
        $response->assertStatus(404);
    });

    it('show page returns 404 for inactive category', function () {
        $category = Category::factory()->create(['is_active' => false]);
        $response = $this->get(route('category', $category->slug));
        $response->assertStatus(404);
    });

    it('show page passes category to view', function () {
        $category = Category::factory()->create(['is_active' => true]);
        $response = $this->get(route('category', $category->slug));
        $response->assertViewHas('category');
    });
});
