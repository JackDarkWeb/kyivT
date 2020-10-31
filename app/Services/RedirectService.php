<?php


namespace App\Services;


use Illuminate\Http\RedirectResponse;

class RedirectService
{
    /**
     * @param $routeName
     * @return RedirectResponse
     */
    static function redirect($routeName){
        return redirect()->route($routeName, ['lang' => app()->getLocale()]);
    }
}
