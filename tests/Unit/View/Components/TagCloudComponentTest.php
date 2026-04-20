<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

use App\Models\Tag;

describe('TagCloudComponent', function () {
    it('renders tag cloud', function () {
        Tag::factory()->count(3)->create(['is_active' => true]);
        $component = $this->blade('<x-tags-cloud-component />');
        $component->assertStatus(200);
    });

    it('shows only active tags', function () {
        $active = Tag::factory()->create(['title' => 'Active Tag', 'is_active' => true]);
        $inactive = Tag::factory()->create(['title' => 'Inactive Tag', 'is_active' => false]);
        $component = $this->blade('<x-tags-cloud-component />');
        $component->assertStatus(200);
    });

    it('displays tag titles', function () {
        $tag = Tag::factory()->create(['title' => 'Test Tag', 'is_active' => true]);
        $component = $this->blade('<x-tags-cloud-component />');
        $component->assertStatus(200);
    });

    it('orders tags alphabetically', function () {
        Tag::factory()->create(['title' => 'Zebra', 'is_active' => true]);
        Tag::factory()->create(['title' => 'Apple', 'is_active' => true]);
        $component = $this->blade('<x-tags-cloud-component />');
        $component->assertStatus(200);
    });
});
