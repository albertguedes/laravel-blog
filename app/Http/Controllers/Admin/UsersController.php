<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;

class UsersController extends Controller
{

    protected function getRoutes( User $user ){
        return [
            [
                'url' => route('users.show',compact('user')),
                'name' => 'Show'
            ],
            [
                'url' => route('users.edit',compact('user')),
                'name' => 'Edit'
            ],
            [
                'url' => route('users.delete',compact('user')),
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
        $users = User::orderBy('id','ASC')->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreRequest $request )
    {

        $validated = $request->validated();

        $data = $validated['user'];

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return redirect()->route('users.show',compact('user'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user )
    {
        $routes = $this->getRoutes($user);
        return view('admin.users.show',compact('user','routes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user )
    {
        $routes = $this->getRoutes($user);
        return view('admin.users.edit',compact('user','routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateRequest $request, User $user )
    {

        $validated = $request->validated();
        
        $data = $validated['user'];

        if( isset($data['password']) || !empty($data['password']) ){
            $data['password'] = Hash::make($data['password']);
        }
    
        $user->update($data);

        return redirect()->route('users.show',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete( User $user )
    {
        $routes = $this->getRoutes($user);
        return view('admin.users.delete',compact('user','routes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, User $user )
    {

        if( ( $request->query('answer') !== null ) && ( $request->query('answer') == 1 ) ){
            $user->delete();
            return redirect()->route('users.index');
        }

        $routes = $this->getRoutes($user);
        return redirect()->route('users.show',compact('user'));

    }

}
