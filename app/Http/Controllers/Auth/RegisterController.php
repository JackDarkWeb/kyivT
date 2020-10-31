<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;

use App\Services\RedirectService;
use App\Services\UserService;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{

    function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @return Application|Factory|View
     */
    function showRegisterForm(){
        return view('auth.register');
    }

    /**
     * @param RegisterFormRequest $formRequest
     * @return RedirectResponse
     */
    protected function store(RegisterFormRequest $formRequest){
        $user = UserService::create($formRequest);
        if($user){
            UserService::createSession($user);
            return RedirectService::redirect('dashboard');
        }
        return RedirectService::redirect('register');
    }
}
