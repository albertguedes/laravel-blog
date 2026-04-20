<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\QuestionClassifierService;

describe('QuestionClassifierService', function () {
    beforeEach(function () {
        $this->service = new QuestionClassifierService;
    });

    it('classifies quantity question as stats', function () {
        expect($this->service->classify('Quantos posts existem?'))->toBe('stats');
    });

    it('classifies question with quantidade as stats', function () {
        expect($this->service->classify('Qual a quantidade de usuários?'))->toBe('stats');
    });

    it('classifies question with número as stats', function () {
        expect($this->service->classify('Número de posts publicados?'))->toBe('stats');
    });

    it('classifies question with maior as stats', function () {
        expect($this->service->classify('Qual é o maior post?'))->toBe('stats');
    });

    it('classifies question with menor as stats', function () {
        expect($this->service->classify('Qual é o menor post?'))->toBe('stats');
    });

    it('classifies question about author as stats', function () {
        expect($this->service->classify('Quantos autores ativos?'))->toBe('stats');
    });

    it('classifies question about active as stats', function () {
        expect($this->service->classify('Quantos usuários estão ativos?'))->toBe('stats');
    });

    it('classifies question about inactive as stats', function () {
        expect($this->service->classify('Quantos autores inativos?'))->toBe('stats');
    });

    it('classifies RAG question as rag', function () {
        expect($this->service->classify('Explique como funciona Laravel'))->toBe('rag');
    });

    it('is case insensitive', function () {
        expect($this->service->classify('QUANTOS POSTS'))->toBe('stats');
        expect($this->service->classify('Maior Post'))->toBe('stats');
    });
});
