<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UsersController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {

        $users = User::orderBy('id','ASC')->paginate(10);

        return view('admin.users.index',compact('users'));

    }

    /**
     * Display the user data.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function show( User $user ): View
    {
        return view('admin.users.show', compact('user') );
    }

    /**
     * Show the form for creating a new user.
     *
    * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     *
     * @param \App\Http\Requests\Admin\Users\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( StoreRequest $request ): RedirectResponse
    {

        $validated = $request->validated();

        $validated['user']['password'] = Hash::make($validated['user']['password']);

        $user = User::create($validated['user']);

        return redirect()->route('users.show',compact('user'));

    }

    /**
     * Show the form for editing the user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit( User $user ): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user.
     *
     * @param  \App\Http\Requests\Admin\Users\UpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request, User $user ): RedirectResponse
    {

        $validated = $request->validated();

        // If password was given, its crypted , else, the variable is droped to
        // not try save empty password on database ( this causes error ).
        if( isset($validated['user']['password']) && !empty($validated['user']['password']) ){
            $validated['user']['password'] = Hash::make($validated['user']['password']);
        }
        else{
             unset($validated['user']['password']);
        }

        $user->update($validated['user']);
        $user->save();

        return redirect()->route('users.show',compact('user'));

    }

    /**
     * Show the form for delete the user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Contracts\View\View
     */
    public function delete( User $user ): View
    {
        return view('admin.users.delete', compact( 'user') );
    }

    /**
     * Delete the the user.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( Request $request, User $user ): RedirectResponse
    {

        $user->delete();

        return redirect()->route('users.index');

    }

}
