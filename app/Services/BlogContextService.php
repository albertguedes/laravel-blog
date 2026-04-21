<?php

namespace App\Services;

/**
 * Service for retrieving blog context and metadata.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class BlogContextService
{
    /**
     * Get the blog context as a formatted string.
     *
     * @return string Blog name, description, and creator
     */
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
