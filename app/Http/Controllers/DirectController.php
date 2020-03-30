<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SupportRequest;
use App\User;

class DirectController extends Controller
{

    public function __invoke(Request $request, $link)
    {
        //найти  заявку по ссылке
         $req = SupportRequest::where('link', $link)->firstOrFail();

         //Найти менeджера
        $manger = User::where('is_manager', true)->firstOrFail();

        Auth::login($manger);

        return redirect()->route("request_view", ['id' => $req->id]);
    }
}
