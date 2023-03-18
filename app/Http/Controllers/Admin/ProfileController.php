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
     * Update profile data.
     */
    public function update( UpdateRequest $request )
    {

        $validated = $request->validated();

        if( isset($validated['user']['password']) && !empty($validated['user']['password']) ){
            $validated['user']['password'] = Hash::make($validated['user']['password']);
        }
        else{
            unset($validated['user']['password']);
        }

        Auth::user()->update($validated['user']);

        return redirect()->route('profile');

    }

}
