<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

/**
 * Controller for author-related pages.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class AuthorsController extends Controller
{
    protected const PER_PAGE = 9;

    /**
     * Display a listing of authors.
     */
    public function index(): View
    {
        $authors = User::whereHas('posts', function ($q) {
            $q->where('published', true);
        })
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->orderBy('profiles.name')
            ->paginate(self::PER_PAGE);

        return view('authors.index', compact('authors'));
    }

    /**
     * Shows a single author and their published posts.
     */
    public function show(User $author): View
    {
        $posts = $author->posts()
            ->where('published', true)
            ->orderBy('updated_at', 'DESC')
            ->paginate(9);

        return view('authors.show', compact('author', 'posts'));
    }
}
