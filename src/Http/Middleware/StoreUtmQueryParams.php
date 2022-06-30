<?php

namespace Astrogoat\Utm\Http\Middleware;

use Closure;

class StoreUtmQueryParams
{

    public function handle($request, Closure $next)
    {
        $utmQueryParams = [
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'utm_term',
            'fbclid',
            'gclid',
            'ttclid',
            'irclid',
            'user_id'
        ];

        foreach ($utmQueryParams as $utmQueryParam) {
            if ($request->has($utmQueryParam)) {
                session()->put($utmQueryParam, $request->input($utmQueryParam));
            }
        }

        return $next($request);
    }
}
