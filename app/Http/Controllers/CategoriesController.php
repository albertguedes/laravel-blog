<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

use App\Models\Category;

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
     * @param  \App\Models\Category $category
     * @return \Illuminate\View\View|Symfony\Component\HttpFoundation\Response
     */
    public function show (Category $category): View
    {
        if (!$category || !$category->is_active) {
            return view('errors.404');
        }

        return view('categories.show', compact('category'));
    }
}
