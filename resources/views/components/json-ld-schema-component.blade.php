<script type="application/ld+json">
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => $type ?? 'WebSite',
        'name' => config('app.name'),
        'url' => url('/'),
        'description' => config('app.tagline'),
        'author' => ! empty($author) ? $author : [
            '@type' => 'Person',
            'name' => config('app.author')
        ]
    ];
@endphp
{!! json_encode($schema, JSON_UNESCAPED_SLASHES) !!}
</script>
