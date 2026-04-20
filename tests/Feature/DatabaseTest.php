<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_conexao_com_banco_de_dados()
    {
        $database = DB::connection()->getDatabaseName();
        $this->assertEquals(':memory:', $database);
    }
}
