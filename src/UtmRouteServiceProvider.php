<?php

namespace Astrogoat\Utm;

use Astrogoat\Utm\Http\Middleware\StoreUtmQueryParams;
use Astrogoat\Utm\Settings\UtmSettings;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Event;
use Stancl\Tenancy\Events\TenancyBootstrapped;

class UtmRouteServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        Event::listen(TenancyBootstrapped::class, function () {
            if (! app()->runningInConsole() && app(UtmSettings::class)->isEnabled()) {
                $this->pushMiddlewareToGroup('web', StoreUtmQueryParams::class);
            }
        });
    }
}
