<?php declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function test_index_retorna_view_com_lista_de_categorias ()
    {
        $response = $this->get(route('categories'));
        //$response->assertSuccessful();
        $response->assertViewIs('categories');
        $response->assertStatus(200);
    }
}
