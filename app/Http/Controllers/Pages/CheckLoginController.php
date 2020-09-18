<?php


namespace App\Http\Controllers\Pages;


use Illuminate\Support\Facades\Auth;

class CheckLoginController extends \App\Http\Controllers\PagesController
{
    public function getCheckLogin($url){
        if(Auth::check()){
            $geturl = str_replace('&','/',$url);
            return redirect($geturl);
        }
        return view('pages.check_login');
    }
}
