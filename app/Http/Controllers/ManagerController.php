<?php

namespace App\Http\Controllers;

use App\SupportRequest;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('manager');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @param string $filter
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $filter = null)
    {
        $requests = null;

        //значения фильтров для отображения в форме 0 - е закрытые, 1-закрытые, 2 -все
        $filters = ['viewed' => 2, "answered" => 2, "closed" => 2];

        if($filter){

            $arr = explode("=", $filter);

            $filters[$arr[0]] = $arr[1];

            $requests = SupportRequest::where('is_' . $arr[0], $arr[1])->get();

        }
        else
            $requests = SupportRequest::all();




        return view('manager.index',[
            'requests' => $requests,
            'filters' => $filters//null or array
        ]);
    }
}
