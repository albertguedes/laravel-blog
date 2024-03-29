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
    public function edit( Request $request ){
        return view('admin.profile.edit');
    }

    /**
     * Update profile data.
     */
    public function update( UpdateRequest $request )
    {

        $validated = $request->validated();

        if( isset($validated['profile']['password']) && !empty($validated['profile']['password']) ){
            $data['password'] = Hash::make($validated['profile']['password']);
        }
        else{
            unset($validated['profile']['password']);
        }

        Auth::user()->update($validated['profile']);

        return redirect()->route('profile');

    }

}
