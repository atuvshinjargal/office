<?php

namespace TaskSharing\Http\Controllers\Auth;

use TaskSharing\Http\Controllers\Controller;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var Guard
     */
    protected $guard;

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->guard = $guard;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return $this->view('login');
    }

    /**
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [], [
            'email' => 'e-mail',
            'password' => 'password'
        ]);

        if ($this->guard->attempt($request->except('_token'), true)) {
            return redirect()->intended();
        }

        return $this->redirectBack()->withErrors('Please try again.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        $this->guard->logout();

        return redirect('login');
    }
}
