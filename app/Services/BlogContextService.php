<?php

namespace App\Services;

class BlogContextService
{
    public function get(): string
    {
        $blog = config('blog');

        return <<<TEXT
Nome do blog: {$blog['name']}
Descrição: {$blog['description']}
Criador: {$blog['creator']}
TEXT;
    }
}
