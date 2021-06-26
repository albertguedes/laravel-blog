<?='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ {{ env('APP_NAME') }} ]]></title>
        <link><![CDATA[ {{ route('rss') }} ]]></link>
        <description><![CDATA[ A simple blog made with Laravel ]]></description>
        <language>pt-br</language>
        <pubDate>{{ now() }}</pubDate>
        @foreach( $posts as $post )
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('post',['post'=>$post]) }}</link>
            <description><![CDATA[{!! substr($post->content,0,300)."..." !!}]]></description>
            <category></category>
            <author></author>
            <guid>{{ $post->id }}</guid>
            <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
        </item>
        @endforeach
    </channel>
</rss>