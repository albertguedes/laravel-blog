<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateRequest;

class ProfileController extends Controller
{

    /**
     * Show profile view.
     */
    public function show(){
        return view('admin.profile.show');
    }

    /**
     * Show edit view.
     */
    public function edit(){
        return view('admin.profile.edit');
    }


    /**
     * Update user profile.
     *
     * @param UpdateRequest $request
     * @return void
     */
    public function update( UpdateRequest $request )
    {

        $validated = $request->validated();

        $profile = $validated['profile'];

        if( isset($profile['password']) && !empty($profile['password']) ){
            $profile['password'] = Hash::make($profile['password']);
        }
        else{
            unset($profile['password']);
        }

        Auth::user()->update($profile);

        return redirect()->route('profile');

    }

}
