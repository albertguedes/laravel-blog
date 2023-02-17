<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\View\View;

class CategoriesController extends Controller
{

    /**
     * Get routes for the tabs.
     *
     * @param \App\Models\Category $category
     * @return array
     */
    protected function getRoutes( Category $category ): array {
        return [
            [
                'url' => route('categories.show',compact('category')),
                'name' => 'Show'
            ],
            [
                'url' => route('categories.edit',compact('category')),
                'name' => 'Edit'
            ],
            [
                'url' => route('categories.delete',compact('category')),
                'name' => 'Delete'
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

        $categories = Category::orderBy('id','ASC')->paginate(10);

        return view('admin.categories.index',compact('categories'));

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
        $data      = $validated['category'];

        $category = Category::create($data);
        $category->save();

        return redirect()->route('categories.show',compact('category'));

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
        $routes = $this->getRoutes($category);
        return view('admin.categories.show',compact('category','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function edit( Category $category = null ): View
    {
        $routes = $this->getRoutes($category);
        return view('admin.categories.edit',compact('category','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Categories\UpdateRequest $request
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, Category $category = null ): RedirectResponse
    {

        $validated = $request->validated();

        $data      = $validated['category'];
        if (isset($validated['category_id'])) {
            $data['parent_id'] = $validated['category_id'];
        }

        $category->update($data);
        $category->save();

        return redirect()->route('categories.show',compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function delete( Category $category = null ): View
    {
        $routes = $this->getRoutes($category);
        return view('admin.categories.delete',compact('category','routes'));
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
