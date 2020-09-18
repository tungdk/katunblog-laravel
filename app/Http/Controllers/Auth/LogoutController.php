<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller
{
    public function getLogout()
    {
        Auth::logout();
        session()->flush();
        return Redirect::to('home');
    }
}
