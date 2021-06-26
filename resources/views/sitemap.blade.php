<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>2021-06-25</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
    @foreach( $posts as $post )
    <url>
        <loc>{{ route('post',compact('post') ) }}</loc>
        <lastmod>{{ $post->updated_at->toRssString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
    <url>
        <loc>{{ route('about') }}</loc>
        <lastmod>2021-06-25</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <lastmod>2021-06-25</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
</urlset>