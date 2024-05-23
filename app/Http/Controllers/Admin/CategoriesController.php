<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.categories.index',[
            'categories' => Category::orderBy('id','ASC')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Categories\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request ): RedirectResponse
    {
        $validated = $request->validated();

        return redirect()->route('categories.show', [
            ' category' => Category::create($validated['category'])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\View\View
     *
     */
    public function show( Category $category ): View
    {
        return view('admin.categories.show', compact('category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function edit( Category $category ): View
    {
        return view('admin.categories.edit',compact('category') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Categories\UpdateRequest $request
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, Category $category ): RedirectResponse
    {
        $validated = $request->validated();

        if (isset($validated['category']['parent_id']))
        {
            // Get the parent candidate.
            $parent = Category::find($validated['category']['parent_id']);

            if (CategoryHelper::hasDescendant($parent,$category)) {
                return back()->withErrors([
                    'danger' => 'You can not set a category as a child of its own descendant'
                ]);
            }
        }

        $category->update($validated['category']);
        $category->save();

        return redirect()->route('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function delete( Category $category ): View
    {
        return view('admin.categories.delete', compact('category') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Category $category ): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
