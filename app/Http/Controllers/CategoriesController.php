<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\View\View|Symfony\Component\HttpFoundation\Response
     */
    public function show (Category $category): View|Response
    {
        if (!$category->exists() || !$category->is_active) {
            return response('errors.404', Response::HTTP_NOT_FOUND);
        }

        return view('category', compact('category'));
    }
}
