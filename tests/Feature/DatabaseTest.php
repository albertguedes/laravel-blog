<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_conexao_com_banco_de_dados()
    {
        $database = DB::connection()->getDatabaseName();
        $this->assertEquals(':memory:',$database);
    }
}
