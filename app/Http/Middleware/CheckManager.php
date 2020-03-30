<?php

namespace App\Http\Middleware;

use Closure;


class CheckManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if($request->user()->is_manager)  return $next($request);

        $request->session()->put("error", "Вы не авторизованы для просмотра этого ресссурса");

        return redirect()->route("error");
    }
}
