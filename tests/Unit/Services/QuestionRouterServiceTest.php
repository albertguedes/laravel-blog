<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\QuestionRouterService;

describe('QuestionRouterService', function () {
    beforeEach(function () {
        $this->service = new QuestionRouterService;
    });

    describe('SQL routing patterns', function () {
        it('routes "últimos 10 posts" to SQL', function () {
            expect($this->service->route('últimos 10 posts'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "últimos posts" to SQL', function () {
            expect($this->service->route('últimos posts'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "ultimo post" to SQL', function () {
            expect($this->service->route('ultimo post'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "posts recentes" to SQL', function () {
            expect($this->service->route('posts recentes'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "quem são os autores" to SQL', function () {
            expect($this->service->route('quem são os autores'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "quem são os autores do blog" to SQL', function () {
            expect($this->service->route('quem são os autores do blog'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "autores dos posts" to SQL', function () {
            expect($this->service->route('autores dos posts'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "lista de autores" to SQL', function () {
            expect($this->service->route('lista de autores'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "mostrar autores" to SQL', function () {
            expect($this->service->route('mostrar autores'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "listar autores" to SQL', function () {
            expect($this->service->route('listar autores'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "quantos posts" to SQL', function () {
            expect($this->service->route('quantos posts'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "posts do autor João" to SQL', function () {
            expect($this->service->route('posts do autor João'))->toBe(QuestionRouterService::INTENT_SQL);
        });

        it('routes "posts da categoria PHP" to SQL', function () {
            expect($this->service->route('posts da categoria PHP'))->toBe(QuestionRouterService::INTENT_SQL);
        });
    });

    describe('RAG routing patterns', function () {
        it('routes content questions to RAG', function () {
            expect($this->service->route('explique como funciona Laravel'))->toBe(QuestionRouterService::INTENT_RAG);
        });

        it('routes "o que é PHP" to RAG', function () {
            expect($this->service->route('o que é PHP?'))->toBe(QuestionRouterService::INTENT_RAG);
        });

        it('routes "como fazer deploy" to RAG', function () {
            expect($this->service->route('como fazer deploy de uma aplicação Laravel?'))->toBe(QuestionRouterService::INTENT_RAG);
        });
    });

    describe('case insensitivity', function () {
        it('is case insensitive for SQL patterns', function () {
            expect($this->service->route('ÚLTIMOS 10 POSTS'))->toBe(QuestionRouterService::INTENT_SQL);
            expect($this->service->route('QUEM SÃO OS AUTORES'))->toBe(QuestionRouterService::INTENT_SQL);
            expect($this->service->route('POSTS RECENTES'))->toBe(QuestionRouterService::INTENT_SQL);
        });
    });
});
