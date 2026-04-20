<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request): View
    {
        $query = $request->get('q', '');

        $results = new LengthAwarePaginator([], 1, 1);
        if (! empty($query)) {
            $key = 'search:'.md5($query);

            $ids = Cache::remember($key, 600, function () use ($query) {
                return Post::where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%")
                    ->orderByDesc('created_at')
                    ->pluck('id')
                    ->all();
            });

            $results = Post::whereIn('id', $ids)
                ->orderByDesc('created_at')
                ->paginate(5)
                ->withQueryString();
        }

        return view('search', compact('query', 'results'));
    }
}
