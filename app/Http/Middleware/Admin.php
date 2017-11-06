<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        //admin middleware-ot go registrirame vo kernel  a go stavame vo __construct metod vo klasata(controller-ot koj sakame da go zastitime)
        
        
        //prasuvame dali korisnikot e logiran kako admin
        if(Auth::user()->admin) {
            //ako e logiran kako admin mu dozvoluvame da odi do posakuvanata strana
            return $next($request);
        }else {
            //ako ne  e logiran kako admin go vracame nazad
            return redirect()->back();
            
        }
    }
}
