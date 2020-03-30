<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupportRequest;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $entities = SupportRequest::where('user_id', $request->user()->id )->orderBy('updated_at', 'desc')->get();

        return view('client\index', ['requests' => $entities]);
    }
}
