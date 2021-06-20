<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('admin.auth.login');
    }

    public function authenticate( LoginRequest $request )
    {


        $validated = $request->validated();

        $credentials = $validated['credentials'];

        /**
         * This works. If code editor acuse that some method dont exists, dont believe!
         */
        $result = Auth::guard('web')->attempt($credentials);

        if( $result ){
            $user = Auth::guard('web')->user();
            return redirect()->route('dashboard');
        }

      //  dd($result);
        return redirect()->route('login');
//        $2y$10$OpNdiJZNGt1b.VLIGiNYQucIAGm5rrex6WRDduCw3IUlym7rzVQwS
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
