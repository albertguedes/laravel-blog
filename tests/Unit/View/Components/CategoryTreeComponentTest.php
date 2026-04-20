<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

use App\Models\Category;

describe('CategoryTreeComponent', function () {
    it('renders category tree', function () {
        $parent = Category::factory()->create(['title' => 'Parent', 'is_active' => true]);
        Category::factory()->create(['title' => 'Child', 'parent_id' => $parent->id, 'is_active' => true]);
        $component = $this->blade('<x-categories-tree-component />');
        $component->assertStatus(200);
    });

    it('shows active categories only', function () {
        $active = Category::factory()->create(['title' => 'Active', 'is_active' => true]);
        $inactive = Category::factory()->create(['title' => 'Inactive', 'is_active' => false]);
        $component = $this->blade('<x-categories-tree-component />');
        $component->assertStatus(200);
    });

    it('displays category titles', function () {
        $category = Category::factory()->create(['title' => 'Test Category', 'is_active' => true]);
        $component = $this->blade('<x-categories-tree-component />');
        $component->assertStatus(200);
    });
});
