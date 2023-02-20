<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\StoreRequest;
use App\Http\Requests\Admin\Tags\UpdateRequest;
use App\Models\Tag;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagsController extends Controller
{

    /**
     * Get routes for the tabs.
     *
     * @param \App\Models\Tag $tag
     * @return array
     */
    protected function getRoutes( Tag $tag = null ){
        return [
            [
                'url' => route('tags.show',compact('tag')),
                'name' => 'Show'
            ],
            [
                'url' => route('tags.edit',compact('tag')),
                'name' => 'Edit'
            ],
            [
                'url' => route('tags.delete',compact('tag')),
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
        $tags = Tag::orderBy('id','ASC')->paginate(10);
        return view('admin.tags.index',compact( 'tags' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Tags\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request ): RedirectResponse
    {

        $validated = $request->validated();
        $data      = $validated['tag'];

        $tag = Tag::create($data);
        $routes = $this->getRoutes($tag);

        return redirect()->route("tags.show",compact('tag','routes'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\View\View
     */
    public function show( Tag $tag ): View
    {
        $routes = $this->getRoutes($tag);
        return view('admin.tags.show',compact('tag','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag $category
     * @return \Illuminate\View\View
     */
    public function edit( Tag $tag ): View
    {
        $routes = $this->getRoutes($tag);
        return view('admin.tags.edit',compact('tag','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Tags\UpdateRequest $request
     * @param \App\Models\Tag $tag
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, Tag $tag ): RedirectResponse
    {
        $validated = $request->validated();
        $data = $validated['tag'];
        $tag->update($data);
        return redirect()->route('tags.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tag $tag
     *
     * @return \Illuminate\View\View
     */
    public function delete( Tag $tag ): View
    {
        $routes = $this->getRoutes($tag);
        return view('admin.tags.delete', compact('tag','routes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Tag $tag ): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }

}
