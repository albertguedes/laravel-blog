<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{

    use RefreshDatabase;

    public function test_conexao_com_banco_de_dados_de_teste()
    {
        $database = DB::connection()->getDatabaseName();
        $this->assertEquals('laravel_test_portfolio_blogdb',$database);
    }



}
