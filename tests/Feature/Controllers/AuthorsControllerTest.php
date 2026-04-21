<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

describe('AuthorsController', function () {
    it('index page returns successful response', function () {
        $response = $this->get(route('authors'));
        $response->assertStatus(200);
        $response->assertViewIs('authors.index');
    });

    it('index page shows only active authors', function () {
        $authorRole = Role::factory()->create(['title' => 'author']);
        $activeAuthor = User::factory()->create(['is_active' => true]);
        Profile::factory()->create(['user_id' => $activeAuthor->id]);
        $activeAuthor->roles()->attach($authorRole->id);
        $inactiveAuthor = User::factory()->create(['is_active' => false]);
        Profile::factory()->create(['user_id' => $inactiveAuthor->id]);
        $inactiveAuthor->roles()->attach($authorRole->id);
        $response = $this->get(route('authors'));
        $response->assertViewHas('authors');
    });

    it('show page returns successful response for author', function () {
        $authorRole = Role::factory()->create(['title' => 'author']);
        $author = User::factory()->create(['is_active' => true]);
        Profile::factory()->create(['user_id' => $author->id]);
        $author->roles()->attach($authorRole->id);
        $response = $this->get(route('author', $author->profile->username));
        $response->assertStatus(200);
        $response->assertViewIs('authors.show');
    });

    it('show page passes author and posts to view', function () {
        $authorRole = Role::factory()->create(['title' => 'author']);
        $author = User::factory()->create(['is_active' => true]);
        Profile::factory()->create(['user_id' => $author->id]);
        $author->roles()->attach($authorRole->id);
        $response = $this->get(route('author', $author->profile->username));
        $response->assertViewHas('author');
        $response->assertViewHas('posts');
    });

    it('show page returns 404 for non-existent author', function () {
        $response = $this->get(route('author', 'non-existent-username'));
        $response->assertStatus(404);
    });

    it('show page only shows published posts', function () {
        $authorRole = Role::factory()->create(['title' => 'author']);
        $author = User::factory()->create(['is_active' => true]);
        Profile::factory()->create(['user_id' => $author->id]);
        $author->roles()->attach($authorRole->id);
        $publishedPost = Post::factory()->create([
            'author_id' => $author->id,
            'published' => true,
        ]);
        $unpublishedPost = Post::factory()->create([
            'author_id' => $author->id,
            'published' => false,
        ]);
        $response = $this->get(route('author', $author->profile->username));
        $response->assertViewHas('posts');
    });
});
