<?php

declare(strict_types=1);

namespace Tests\Unit\View\Components;

describe('JsonLdSchema', function () {
    it('renders JSON-LD schema with default values', function () {
        $html = view('components.common.json-ld-schema')->render();
        expect($html)->toContain('"@context"');
        expect($html)->toContain('"@type"');
        expect($html)->toContain('"WebSite"');
    });

    it('renders with custom type', function () {
        $html = view('components.common.json-ld-schema', ['type' => 'Article'])->render();
        expect($html)->toContain('"Article"');
    });

    it('renders with custom author array', function () {
        $author = ['@type' => 'Organization', 'name' => 'Test Org'];
        $html = view('components.common.json-ld-schema', ['type' => 'WebSite', 'author' => $author])->render();
        expect($html)->toContain('"Organization"');
        expect($html)->toContain('"Test Org"');
    });
});
