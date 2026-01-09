<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

use App\Models\Post;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request): View
    {
        $query = $request->get('q', '');

        $results = new \Illuminate\Pagination\LengthAwarePaginator([], 1, 1);
        if (!empty($query)) {
            $key = 'search:' . md5($query);

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

        return view('search', compact('query','results'));
    }
}
