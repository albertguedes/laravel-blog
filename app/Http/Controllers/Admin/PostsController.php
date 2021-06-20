<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostsController extends Controller
{

    protected function getRoutes( Post $post ){
        return [
            [
                'url' => route('posts.show',compact('post')),
                'name' => 'Show'
            ],
            [
                'url' => route('posts.edit',compact('post')),
                'name' => 'Edit'
            ],
            [
                'url' => route('posts.delete',compact('post')),
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
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $post = Post::create($request->post);
        $routes = $this->getRoutes($post);
        return redirect()->route('posts.show',compact('post','routes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Post $post )
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.show',compact('post','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Post $post )
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.edit',compact('post','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Post $post )
    {
        $post->update($request->post);
        return redirect()->route('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete( Post $post )
    {
        $routes = $this->getRoutes($post);
        return view('admin.posts.delete',compact('post','routes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, Post $post )
    {

        if( ( $request->query('answer') !== null ) && ( $request->query('answer') == 1 ) ){
            $post->delete();
            return redirect()->route('posts.index');
        }

        $routes = $this->getRoutes($post);
        return redirect()->route('posts.show',compact('post','route'));

    }

}
