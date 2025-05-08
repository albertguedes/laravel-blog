<?php declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user_data = [
        'name'     => 'author de teste',
        'username' => 'username de teste',
        'email'    => 'email de teste',
        'password' => 'password de teste',
        'is_active' => true
    ];

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

    public function test_index_retorna_view_com_posts()
    {
        $response = $this->get(route('home'));
        $response->assertSuccessful();
        $response->assertViewIs('index');
        $response->assertStatus(200);
    }

    public function test_show_retorna_view_com_post()
    {
        $author = User::create($this->user_data);
        $post = Post::create($this->data);
        $post->update([ 'author_id' => $author->id ]);

        $response = $this->get(route('post', $post->slug));
        $response->assertSuccessful();
        $response->assertViewIs('post'); // Verifica se a view correta foi retornada
        $response->assertViewHas('post', $post);
        $response->assertStatus(200);
    }

    public function test_show_retorna_404_se_post_nao_existe()
    {
        $response = $this->get(route('post', 'invalid-slug'));
        $response->assertStatus(404);
    }

    public function test_show_retorna_404_se_post_nao_foi_publicado()
    {
        $author = User::create($this->user_data);
        $post = Post::create($this->data);
        $post->update([ 'author_id' => $author->id, 'published' => false ]);

        $response = $this->get(route('post', $post->slug));
        $response->assertStatus(404);
    }

    public function test_archive_retorna_view_com_posts()
    {
        $response = $this->get(route('archive'));
        $response->assertSuccessful();
        $response->assertViewIs('archive');
        $response->assertStatus(200);
    }
}
