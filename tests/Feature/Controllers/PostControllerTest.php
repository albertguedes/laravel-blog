<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Post;
use App\Models\User;

describe('PostController', function () {
    it('home page returns successful response', function () {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertViewIs('index');
    });

    it('home page shows published posts', function () {
        $post = Post::factory()->create(['published' => true]);
        $response = $this->get(route('home'));
        $response->assertViewHas('posts');
    });

    it('post page returns successful response for published post', function () {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'author_id' => $user->id,
            'published' => true,
        ]);
        $response = $this->get(route('post', $post->slug));
        $response->assertStatus(200);
        $response->assertViewIs('post');
    });

    it('post page returns 404 for non-existent slug', function () {
        $response = $this->get(route('post', 'non-existent-slug'));
        $response->assertStatus(404);
    });

    it('post page returns 404 for unpublished post', function () {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'author_id' => $user->id,
            'published' => false,
        ]);
        $response = $this->get(route('post', $post->slug));
        $response->assertStatus(404);
    });

    it('archive page returns successful response', function () {
        $response = $this->get(route('archive'));
        $response->assertStatus(200);
        $response->assertViewIs('archive');
    });

    it('archive page accepts year month day parameters', function () {
        $response = $this->get(route('archive', ['year' => 2024, 'month' => 6, 'day' => 15]));
        $response->assertStatus(200);
    });
});
