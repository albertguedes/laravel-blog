<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

/**
 * Controller for category-related pages.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View|Symfony\Component\HttpFoundation\Response
     */
    public function show(Category $category): View
    {
        if (! $category || ! $category->is_active) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('categories.show', compact('category'));
    }
}
