<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
     * Display a listing of the users.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {

        $users = User::orderBy('id','ASC')->paginate(10);

        $view = 'admin.users.index';
        $data = compact('users');

        return view($view,$data);

    }

    /**
     * Display the user data.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show( User $user ): View
    {

        $routes = $this->getRoutes($user);

        $view = 'admin.users.show';
        $data = compact('user','routes');

        return view($view,$data);

    }

    /**
     * Show the form for creating a new user.
     *
    * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request ): RedirectResponse
    {

        $validated = $request->validated();
        $data = $validated['user'];
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $route = 'users.show';
        $parameters = compact('user');

        return redirect()->route($route,$parameters);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit( User $user ): View
    {

        $routes = $this->getRoutes($user);

        return view('admin.users.edit', compact('user','routes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Users\UpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, User $user ): RedirectResponse
    {

        $validated = $request->validated();
        $data = $validated['user'];

        if( isset($data['password']) || !empty($data['password']) ){
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        $user->save();

        return redirect()->route('users.show',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function delete( User $user ): View
    {

        $routes = $this->getRoutes($user);

        $view = 'admin.users.delete';
        $data = compact( 'user', 'routes' );

        return view($view,$data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Request $request, User $user ): RedirectResponse
    {

        // Default route and parameter.
        $route = 'users.show';
        $parameters = compact('user');

        if( ( $request->query('answer') !== null ) &&
            ( $request->query('answer') == 1 )
        ){

            $user->delete();

            $route = 'users.index';
            $parameters = [];

        }

        return redirect()->route($route,$parameters);

    }

}
