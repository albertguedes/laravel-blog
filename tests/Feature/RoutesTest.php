<?php

declare(strict_types=1);

namespace Tests\Feature;

describe('Routes', function () {
    it('home page is accessible', function () {
        $response = $this->get('/');
        $response->assertStatus(200);
    });

    it('about page is accessible', function () {
        $response = $this->get('/about');
        $response->assertStatus(200);
    });

    it('archive page is accessible', function () {
        $response = $this->get('/archive');
        $response->assertStatus(200);
    });

    it('categories page is accessible', function () {
        $response = $this->get('/categories');
        $response->assertStatus(200);
    });

    it('tags page is accessible', function () {
        $response = $this->get('/tags');
        $response->assertStatus(200);
    });

    it('authors page is accessible', function () {
        $response = $this->get('/authors');
        $response->assertStatus(200);
    });

    it('search page is accessible', function () {
        $response = $this->get('/search');
        $response->assertStatus(200);
    });

    it('contact page is accessible', function () {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    });

    it('login page is accessible', function () {
        $response = $this->get('/auth/login');
        $response->assertStatus(200);
    });

    it('register page is accessible', function () {
        $response = $this->get('/auth/register');
        $response->assertStatus(200);
    });

    it('password forgot page is accessible', function () {
        $response = $this->get('/auth/password/forgot');
        $response->assertStatus(200);
    });

    it('health check returns ok', function () {
        $response = $this->get('/up');
        $response->assertStatus(200);
    });
});
