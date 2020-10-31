<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailFormRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    function __construct()
    {
        $this->middleware('guest');
    }

    function showEmailForm(){
        return view('auth.passwords.email');
    }

    /**
     * @param EmailFormRequest $formRequest
     * @return RedirectResponse
     */
    protected function store(EmailFormRequest $formRequest){

        if (!UserService::userExist($formRequest)){
            return back()->with('error_email', __('auth.user'))->withInput();
        }
        $token = UserService::getUniqueToken();
        if (UserService::PasswordResetToken($formRequest, $token))
            UserService::sendPasswordResetNotification($formRequest, $token);

        return back()->with('notification', __('passwords.sent'))->withInput();
    }
}
