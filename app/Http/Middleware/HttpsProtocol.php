<?php
/**
 * Force SSL
 * 
 * en relation avec Http\Kernel.php
 *
 * Entourer les routes voulues sécurisées par ce middleware
 * 
 * http://stackoverflow.com/questions/28402726/laravel-5-redirect-to-https
 */
namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        if ( ! $request->secure() && ! preg_match('/tache-cron/', $request->getRequestUri()))
        {
            return redirect()->secure( $request->getRequestUri() );
        }

        return $next($request); 
    }
}