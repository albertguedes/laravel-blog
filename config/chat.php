<?php

declare(strict_types=1);

return [
    'agent' => [
        'prompt' => 'You are a blog assistant that helps users answer questions about the blog. Use the tools available to provide accurate answers based on database data or blog content.',
        'model' => env('OLLAMA_MODEL', 'mannix/llama3.1-8b-abliterated:q4_K_M'),
    ],

    'tools' => [
        'page_links' => [
            'description' => 'Find links to blog pages, posts, categories, tags, authors. Use for questions about page locations, "how to contact", "about page", "categories page", "latest posts", post links, "link to", etc. Returns markdown links. If many results, use the search page.',
            'max_individual_links' => 10,
        ],
        'search_posts' => [
            'description' => 'Search blog posts by topic, keyword, or content. Use when the question is about blog content, topics, knowledge, or what the blog/author discusses.',
        ],
        'query_database' => [
            'description' => 'Query the database for structured data like counts, lists, statistics, filters about posts, users, categories, and tags. Use for questions about quantities, lists, filters, aggregations.',
        ],
    ],
];
