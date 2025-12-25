<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Models\User;

class AuthorsController extends Controller
{
    /**
     * Returns a view of all authors, including their published posts.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $authors = User::whereHas('roles', function ($query) {
            $query->where('title', 'author');
        })
        ->where('is_active', true)
        ->paginate(9);

        return view('authors.index', compact('authors'));
    }

    /**
     * Shows a single author and their published posts.
     *
     * @param  \App\Models\User  $author
     * @return \Illuminate\View\View
     */
    public function show(User $author): View
    {
        if (!$author) {
            return view('errors.404', Response::HTTP_NOT_FOUND);
        }

        $posts = $author->posts()
                        ->where('published', true)
                        ->orderBy('updated_at', 'DESC')
                        ->paginate(9);

        return view('authors.show', compact('author','posts'));
    }
}
