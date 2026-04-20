<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

describe('ArchiveController', function () {
    it('returns successful response', function () {
        $response = $this->get(route('archive'));
        $response->assertStatus(200);
        $response->assertViewIs('archive');
    });

    it('accepts year parameter', function () {
        $response = $this->get(route('archive', ['year' => 2024]));
        $response->assertStatus(200);
        $response->assertViewHas('year', 2024);
    });

    it('accepts month parameter', function () {
        $response = $this->get(route('archive', ['month' => 6]));
        $response->assertStatus(200);
        $response->assertViewHas('month', 6);
    });

    it('accepts day parameter', function () {
        $response = $this->get(route('archive', ['day' => 15]));
        $response->assertStatus(200);
        $response->assertViewHas('day', 15);
    });

    it('accepts all date parameters together', function () {
        $response = $this->get(route('archive', [
            'year' => 2024,
            'month' => 6,
            'day' => 15,
        ]));
        $response->assertStatus(200);
        $response->assertViewHas('year', 2024);
        $response->assertViewHas('month', 6);
        $response->assertViewHas('day', 15);
    });

    it('handles zero values for date parameters', function () {
        $response = $this->get(route('archive', ['year' => 0, 'month' => 0, 'day' => 0]));
        $response->assertStatus(200);
    });
});
