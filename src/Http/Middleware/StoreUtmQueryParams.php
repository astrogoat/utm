<?php

namespace Astrogoat\Utm\Http\Middleware;

use Astrogoat\Utm\Utm;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreUtmQueryParams
{
    protected Utm $utm;

    public function handle(Request $request, Closure $next)
    {
        $this->utm = app(Utm::class);

        $this->utm->put($this->utm->getMatchingRequestSources($request));

        return $next($request);
    }
}
