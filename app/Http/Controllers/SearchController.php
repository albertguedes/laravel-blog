<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

/**
 * This class is used to search for posts given a query string and return the
 * results paginated 5 per page.
 */
class SearchController extends Controller
{
    /**
     * The number of results to display per page.
     */
    private const PER_PAGE = 5;

    /**
     * The number of seconds to cache search results.
     */
    private const TTL = 600;

    /**
     * This method is used to search for posts given a query string and return the
     * results paginated a defined number per page.
     */
    public function __invoke(Request $request): View
    {
        $query = $request->input('q', '');

        $results = new LengthAwarePaginator([], 1, 1);
        if (! empty($query)) {
            $sanitizedQuery = self::sanitizeForLike($query);
            $key = 'search:'.md5($query);

            $ids = Cache::remember($key, self::TTL, function () use ($sanitizedQuery) {
                return Post::where('status', 'published')
                    ->where(function ($q) use ($sanitizedQuery) {
                        $q->where('title', 'like', "%{$sanitizedQuery}%")
                            ->orWhere('content', 'like', "%{$sanitizedQuery}%")
                            ->orWhereHas('tags', fn ($t) => $t->where('is_active', true)->where('title', 'like', "%{$sanitizedQuery}%"))
                            ->orWhereHas('category', fn ($c) => $c->where('is_active', true)->where('title', 'like', "%{$sanitizedQuery}%"));
                    })
                    ->orderByDesc('created_at')
                    ->pluck('id')
                    ->all();
            });

            $results = Post::whereIn('id', $ids)
                ->where('status', 'published')
                ->orderByDesc('created_at')
                ->paginate(self::PER_PAGE)
                ->withQueryString();
        }

        return view('search', compact('query', 'results'));
    }

    /**
     * Sanitize a query for use in a LIKE clause
     *
     * Addcslashes is used to escape special characters
     * in the query string to prevent SQL injection
     *
     * @param  string  $query  The query to sanitize
     * @return string The sanitized query string
     */
    private static function sanitizeForLike(string $query): string
    {
        return addcslashes($query, '%_');
    }
}
