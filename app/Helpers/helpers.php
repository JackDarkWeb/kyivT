<?php

use Illuminate\Support\Facades\Session;

if(!function_exists('change_language')){

    /**
     * @param string $redirect_lang
     * @return string
     */
    function change_language(string $redirect_lang){

        $request_uri = explode('/', ($_SERVER['REQUEST_URI']));
        $request_uri[1] = $redirect_lang;

        return implode('/', $request_uri);
    }
}

if(!function_exists('user')){
    /**
     * @return false|object
     */
    function user(){
        if (Session::has('auth')){
            return (object)Session::get('auth');
        }
        return false;
    }
}

if(!function_exists('route_name')){
    function route_name($routeName){
        return route($routeName,['lang' => app()->getLocale()]);
    }
}


