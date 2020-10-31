<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Services\RedirectService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    function __construct()
    {
        $this->middleware('guest');
    }

    function showLoginForm(){
        return view('auth.login');
    }

    /**
     * @param LoginFormRequest $formRequest
     * @return bool|RedirectResponse
     */
    protected function store(LoginFormRequest $formRequest){

        if (!UserService::userExist($formRequest)){
            return back()->with('error_login', __('auth.user'))->withInput();
        }

        if (!UserService::verifyPassword($formRequest)){
            return back()->with('error_login', __('auth.password'))->withInput();
        }

        UserService::createSession(UserService::userExist($formRequest));
        return RedirectService::redirect('dashboard');
    }


    /**
     * @return RedirectResponse
     */
    protected function loggedOut(){
        if(Session::has('auth')){
            Session::forget('auth');
            return RedirectService::redirect('login');
        }
        return back();
    }
}
