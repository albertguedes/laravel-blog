<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

use App\Models\Tag;
use App\View\Components\Common\TagCloud;
use Illuminate\Support\Collection;

describe('TagCloud', function () {
    it('can be instantiated with tags', function () {
        $tag = Tag::factory()->create(['title' => 'Test', 'is_active' => true]);
        $component = new TagCloud(new Collection([$tag]));
        expect($component->tags)->toBeArray();
        expect(count($component->tags))->toBe(1);
    });

    it('builds tag data structure with required keys', function () {
        $tag = Tag::factory()->create(['title' => 'Test Tag', 'is_active' => true]);
        $component = new TagCloud(new Collection([$tag]));
        expect($component->tags[0])->toHaveKeys(['id', 'title', 'slug', 'n_posts', 'font_size']);
        expect($component->tags[0]['title'])->toBe('Test Tag');
    });
});
