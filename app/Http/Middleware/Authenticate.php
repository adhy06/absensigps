<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (request()->is('panelkaryawan/*')) {
                return route('login');
            } elseif (request()->is('panel/*')) {
                return route('loginadmin');
            } elseif (request()->is('panelpelanggan/*')) {
                return route('loginpelanggan');
            } elseif (request()->is('/*')) {
                return route('/');
            }
            
        } 
    }
}
