<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\StoreRequest;
use App\Http\Requests\Admin\Tags\UpdateRequest;
use App\Models\Tag;

class TagsController extends Controller
{

    /**
     * Get routes for the tabs.
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::orderBy('id','ASC')->paginate(10);

        return view('admin.tags.index',compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        $data      = $validated['tag'];

        $tag = Tag::create($data);

        $routes = $this->getRoutes($tag);

        return redirect()->route('tags.show',compact('tag','routes'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show( Tag $tag = null )
    {
        $routes = $this->getRoutes($tag);
        return view('admin.tags.show',compact('tag','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Tag $category
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit( Tag $tag = null )
    {
        $routes = $this->getRoutes($tag);
        return view('admin.tags.edit',compact('tag','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * 
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateRequest $request = null, Tag $tag = null )
    {

        $validated = $request->validated();      
        $data      = $validated['tag'];
        $tag->update($data);

        $routes = $this->getRoutes($tag);

        return redirect()->route('tags.show',compact('tag','routes'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tag $tag
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete( Tag $tag = null )
    {

        $routes = $this->getRoutes($tag);

        return view('admin.tags.delete',compact('tag','routes'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request = null, Tag $tag = null )
    {

        if( ( $request->query('answer') !== null ) && ( $request->query('answer') == 1 ) ){
            $tag->delete();
            return redirect()->route('tags.index');
        }

        $routes = $this->getRoutes($tag);

        return redirect()->route('tags.show',compact('tag','route'));

    }

}
