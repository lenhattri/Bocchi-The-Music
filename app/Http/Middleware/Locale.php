<?php

namespace App\Http\Middleware;

class Locale
{
    public function handle($request, Closure $next)
    {
           $language = Session::get('language', config('app.locale'));
           switch ($language) {
            case 'en':
                $language = 'en';
                break;
            
            default:
                $language = 'vi';
                break;
        }
        App::setLocale($language);
        
        return $next($request);
    }
}

