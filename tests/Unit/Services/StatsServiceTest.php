<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\Post;
use App\Services\StatsService;

describe('StatsService', function () {
    beforeEach(function () {
        $this->service = new StatsService;
    });

    it('answers how many posts question', function () {
        Post::factory()->count(5)->create();
        $response = $this->service->answer('Quantos posts existem?');
        expect($response)->toContain('5');
    });

    it('answers biggest post question', function () {
        Post::factory()->create(['content' => 'Short content']);
        $longPost = Post::factory()->create(['content' => str_repeat('a', 1000)]);
        $response = $this->service->answer('Qual é o maior post?');
        expect($response)->toContain($longPost->title);
    });

    it('returns default for unrecognized question', function () {
        $response = $this->service->answer('What is the meaning of life?');
        expect($response)->toContain('Não consegui');
    });

    it('handles question about inactive authors', function () {
        $response = $this->service->answer('Quantos autores inativos existem?');
        expect($response)->toBeString();
    });
});
