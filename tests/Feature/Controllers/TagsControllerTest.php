<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Tag;

describe('TagsController', function () {
    it('index page returns successful response', function () {
        $response = $this->get(route('tags'));
        $response->assertStatus(200);
        $response->assertViewIs('tags.index');
    });

    it('index page shows active tags only', function () {
        $activeTag = Tag::factory()->create(['is_active' => true]);
        $inactiveTag = Tag::factory()->create(['is_active' => false]);
        $response = $this->get(route('tags'));
        $response->assertViewHas('tags');
    });

    it('index page shows tags ordered by title', function () {
        Tag::factory()->create(['title' => 'Zebra', 'is_active' => true]);
        Tag::factory()->create(['title' => 'Apple', 'is_active' => true]);
        $response = $this->get(route('tags'));
        $response->assertViewHas('tags');
    });

    it('show page returns successful response for active tag', function () {
        $tag = Tag::factory()->create(['is_active' => true]);
        $response = $this->get(route('tag', $tag->slug));
        $response->assertStatus(200);
        $response->assertViewIs('tags.show');
    });

    it('show page returns 404 for non-existent tag', function () {
        $response = $this->get(route('tag', 'non-existent'));
        $response->assertStatus(404);
    });

    it('show page returns 404 for inactive tag', function () {
        $tag = Tag::factory()->create(['is_active' => false]);
        $response = $this->get(route('tag', $tag->slug));
        $response->assertStatus(404);
    });

    it('show page passes tag to view', function () {
        $tag = Tag::factory()->create(['is_active' => true]);
        $response = $this->get(route('tag', $tag->slug));
        $response->assertViewHas('tag');
    });
});
