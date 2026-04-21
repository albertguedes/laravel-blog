<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;

describe('BootstrapPagination', function () {
    it('renders pagination with proper Bootstrap classes', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            10,
            9,
            1,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'center',
        ])->render();

        expect($html)->toContain('pagination');
        expect($html)->toContain('justify-content-center');
        expect($html)->toContain('page-item');
        expect($html)->toContain('page-link');
    });

    it('marks active page correctly', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            20,
            9,
            2,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'center',
        ])->render();

        expect($html)->toContain('active');
        expect($html)->toContain('aria-current="page"');
    });

    it('disables previous link on first page', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            10,
            9,
            1,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'center',
        ])->render();

        expect($html)->toContain('disabled');
        expect($html)->toContain('Previous');
    });

    it('shows next link when not on last page', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            20,
            9,
            1,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'center',
        ])->render();

        expect($html)->toContain('Next');
        expect($html)->toContain('rel="next"');
    });

    it('supports right alignment', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            10,
            9,
            1,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'end',
        ])->render();

        expect($html)->toContain('justify-content-end');
    });

    it('does not render when no pages', function () {
        $paginator = new LengthAwarePaginator(
            collect([]),
            0,
            9,
            1,
            ['path' => url('/')]
        );

        $html = view('components.common.bootstrap-pagination', [
            'paginator' => $paginator,
            'alignment' => 'center',
        ])->render();

        expect($html)->toBeEmpty();
    });
});
