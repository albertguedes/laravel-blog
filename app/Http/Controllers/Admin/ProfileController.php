<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateRequest;

class ProfileController extends Controller
{

    protected function getRoutes(){
        return [
            [
                'url' => route('profile'),
                'name' => 'Show'
            ],
            [
                'url' => route('profile.edit'),
                'name' => 'Edit'
            ]
        ];
    }

    /**
     * Show profile view.
     */
    public function show(){ 
        $routes = $this->getRoutes();
        return view('admin.profile.show',compact('routes'));
    }

    /**
     * Show edit view.
     */
    public function edit( Request $request ){
        $routes = $this->getRoutes();
        return view('admin.profile.edit',compact('routes'));
    }

    /**
     * Update profile data.
     */
    public function update( UpdateRequest $request )
    {

        $validated = $request->validated();
        $data = $validated['user'];

        if( isset($data['password']) || !empty($data['password']) ){
            $data['password'] = Hash::make($data['password']);
        }
    
        Auth::user()->update($data);

        return redirect()->route('profile');

    }

}
