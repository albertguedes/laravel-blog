<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class PostControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_response_da_pagina_inicial()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }


    public function test_response_da_pagina_de_post()
    {

        $post = Post::factory()->create()->first();
        $post->published = true;
        $post->save();

        $response = $this->get(route('post', ['post' => $post] ) );
        $response->assertStatus(200);
        $response->assertViewIs('post');
        $response->assertViewHas('post', $post);

    }

}
