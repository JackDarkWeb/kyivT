<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\RedirectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;


class LogoutController extends Controller
{

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
