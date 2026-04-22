<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

use App\Models\Category;
use App\View\Components\Categories\CategoryTree;

describe('Tree', function () {
    it('can be instantiated', function () {
        $component = new CategoryTree;
        expect($component->tree)->toBeArray();
    });

    it('generates category tree structure', function () {
        $parent = Category::factory()->create(['title' => 'Parent', 'is_active' => true]);
        Category::factory()->create(['title' => 'Child', 'parent_id' => $parent->id, 'is_active' => true]);
        $tree = CategoryTree::getCategoryTree();
        expect($tree)->toBeArray();
    });
});
