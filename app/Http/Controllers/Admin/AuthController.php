<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect to login page.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('login');
    }

    /**
     * Login page.
     *
     * @return View
     */
    public function login(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Authenticate the user and redirect to dashboard if ok, and to logout
     * if not.
     *
     * @param \App\Http\Requests\Admin\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate( LoginRequest $request ): RedirectResponse
    {

        $validated = $request->validated();

        $credentials = $validated['credentials'];
        $credentials['is_active'] = true;

        /**
         * This works. If code editor accuse that some method dont exists, dont believe!
         */
        $result = Auth::guard('web')->attempt($credentials);

        if( $result ){

            $user = Auth::guard('web')->user();

            $redirect = redirect()->route('dashboard')->with('success','You are logged.');

        }
        else{

            $redirect = redirect()->route('login')->with('danger','Wrong user or password.');

        }

        return $redirect;

    }

    public function logout(){

        Auth::logout();

        return redirect()->route('login')->with('success','You are logged out.');

    }

}
