<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\Category;

class CategoriesController extends Controller
{

    /**
     * Get routes for the tabs.
     */
    protected function getRoutes( Category $category = null ){
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::orderBy('id','ASC')->paginate(10);
        return view('admin.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreRequest $request )
    {

        $validated = $request->validated();
        $data      = $validated['category'];

        $category = Category::create($data);

        $routes = $this->getRoutes($category);

        return redirect()->route('categories.show',compact('category','routes'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show( Category $category = null )
    {
        $routes = $this->getRoutes($category);
        return view('admin.categories.show',compact('category','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( Category $category = null )
    {
        $routes = $this->getRoutes($category);
        return view('admin.categories.edit',compact('category','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateRequest $request, Category $category = null )
    {

        $validated = $request->validated();
        $data      = $validated['category'];
        $category->update($data);

        $routes = $this->getRoutes($category);

        return redirect()->route('categories.show',compact('category','routes'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function delete( Category $category = null )
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
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, Category $category )
    {

        if( !is_null( $request->query('answer') ) && ( $request->query('answer') == 1 ) ){
            $category->delete();
            return redirect()->route('categories.index');
        }

        $routes = $this->getRoutes($category);

        return redirect()->route('categories.show',compact('category','route'));

    }

}
