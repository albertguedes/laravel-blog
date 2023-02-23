<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use Carbon\Carbon;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    // Teste data to create a new post.
    protected $data = [
        'created_at'  => '2020-02-22 22:22:22',
        'updated_at'  => '2020-02-22 22:22:22',
        'title'       => 'title de teste',
        'slug'        => 'title-de-teste',
        'description' => 'description de teste',
        'content'     => 'content de teste',
        'published'   => true
    ];

    // Test data to update a existing post.
    protected $new_data = [
        'title'       => 'novo title de teste',
        'slug'        => 'novo-title-de-teste',
        'description' => 'novo description de teste',
        'content'     => 'novo content de teste',
        'published'   => false
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_post_pode_ser_criado()
    {

        $user = User::factory()->create()->first();
        $category = Category::factory()->create()->first();

        $post = Post::create(array_merge($this->data, [
            'author_id'   => $user->id,
            'category_id' => $category->id
        ]));

        $this->assertModelExists($post);

    }

    public function test_post_pode_ser_lido()
    {

        $user = User::factory()->create()->first();
        $category = Category::factory()->create()->first();

        $post = Post::create(array_merge($this->data, [
            'author_id'   => $user->id,
            'category_id' => $category->id
        ]));

        $retrievedPost = Post::where('title', $this->data['title'])->first();

        $this->assertEquals($user->id, $retrievedPost->author_id);
        $this->assertEquals($category->id, $retrievedPost->category_id);
        $this->assertEquals($this->data['title'], $retrievedPost->title);
        $this->assertEquals($this->data['slug'], $retrievedPost->slug);
        $this->assertEquals($this->data['description'], $retrievedPost->description);
        $this->assertEquals($this->data['content'], $retrievedPost->content);
        $this->assertEquals($this->data['published'], $retrievedPost->published);

    }

    public function test_post_pode_ser_atualizado()
    {

        $user = User::factory()->create()->first();
        $category = Category::factory()->create()->first();

        $post = Post::create(array_merge($this->data, [
            'author_id'   => $user->id,
            'category_id' => $category->id
        ]));

        $retrievedPost = Post::find($post->id);
        $retrievedPost->update($this->new_data);

        $this->assertEquals($user->id, $retrievedPost->author_id);
        $this->assertEquals($category->id, $retrievedPost->category_id);
        $this->assertEquals($this->new_data['title'], $retrievedPost->title);
        $this->assertEquals($this->new_data['slug'], $retrievedPost->slug);
        $this->assertEquals($this->new_data['description'], $retrievedPost->description);
        $this->assertEquals($this->new_data['content'], $retrievedPost->content);
        $this->assertEquals($this->new_data['published'], $retrievedPost->published);

    }

    public function test_post_pode_ser_apagado()
    {

        $user = User::factory()->create()->first();
        $category = Category::factory()->create()->first();

        $post = Post::create(array_merge($this->data, [
            'author_id'   => $user->id,
            'category_id' => $category->id
        ]));

        $retrievedPost = Post::where('title', $this->data['title'])->first();

        $retrievedPost->delete();

        $this->assertDeleted($retrievedPost);

    }

}

