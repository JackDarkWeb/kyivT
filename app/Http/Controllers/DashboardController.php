<?php

namespace App\Http\Controllers;


use App\Services\UserService;

class DashboardController extends Controller
{
    function index(){
        //dd(UserService::activeUser(user()->id));
        return view('dashboard');
    }
}
