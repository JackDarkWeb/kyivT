<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetFormRequest;
use App\Services\RedirectService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return Application|Factory|RedirectResponse|View
     */
    function showPasswordResetForm(){

        if(!request()->token){
            return back();
        }
        if (!UserService::VerifyResetPasswordLink(request()->token)){
            return redirect()->route('password.request', ['lang' => app()->getLocale()])->with('error_email', __('passwords.token'));
        }
        return view('auth.passwords.reset',[
            'token' => request()->token
        ]);
    }

    /**
     * @param PasswordResetFormRequest $formRequest
     * @return RedirectResponse
     */
    protected function store(PasswordResetFormRequest $formRequest){
        if (UserService::verifyPasswordResetEmailAndToken($formRequest)){
            if (UserService::updateUserPassword($formRequest))
                return RedirectService::redirect('login');
        }
        return back()->with('notification', __('passwords.user'))->withInput();
    }
}
