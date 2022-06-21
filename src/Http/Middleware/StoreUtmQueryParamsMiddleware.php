<?php

namespace Astrogoat\Utm\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StoreUtmQueryParamsMiddleware
{

    public function handle($request, Closure $next)
    {
        $utmQueryParams = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
        ];

//        dd($request);

        foreach ($utmQueryParams as $utmQueryParam) {
            if ($request->has($utmQueryParam)) {
                session()->put($utmQueryParam, $request->input($utmQueryParam));
            }
        }

        return $next($request);
    }
}
