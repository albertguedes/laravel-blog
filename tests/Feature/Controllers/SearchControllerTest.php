<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

describe('SearchController', function () {
    it('returns successful response', function () {
        $response = $this->get(route('search'));
        $response->assertStatus(200);
        $response->assertViewIs('search');
    });

    it('returns empty results for empty query', function () {
        $response = $this->get(route('search', ['q' => '']));
        $response->assertViewHas('results');
    });

    it('returns results for valid query', function () {
        $post = Post::factory()->create([
            'title' => 'Laravel Tutorial',
            'content' => 'Learn Laravel from scratch',
            'published' => true,
        ]);
        $response = $this->get(route('search', ['q' => 'Laravel']));
        $response->assertViewHas('results');
    });

    it('passes query to view', function () {
        $response = $this->get(route('search', ['q' => 'test']));
        $response->assertViewHas('query', 'test');
    });

    it('uses cache for search results', function () {
        $post = Post::factory()->create([
            'title' => 'Cached Post',
            'published' => true,
        ]);
        $query = 'Cached';
        Cache::shouldReceive('remember')
            ->once()
            ->andReturn([$post->id]);
        $response = $this->get(route('search', ['q' => $query]));
        $response->assertStatus(200);
    });

    it('searches in title and content', function () {
        $titleMatch = Post::factory()->create([
            'title' => 'Unique Title Here',
            'published' => true,
        ]);
        $contentMatch = Post::factory()->create([
            'title' => 'Other Title',
            'content' => 'Unique Content Here',
            'published' => true,
        ]);
        $response = $this->get(route('search', ['q' => 'Unique']));
        $response->assertViewHas('results');
    });
});
