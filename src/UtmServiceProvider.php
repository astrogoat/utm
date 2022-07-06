<?php

namespace Astrogoat\Utm;

use Astrogoat\Utm\Http\Middleware\StoreUtmQueryParams;
use Astrogoat\Utm\Settings\UtmSettings;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Illuminate\Support\Facades\Event;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stancl\Tenancy\Events\TenancyBootstrapped;

class UtmServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('utm')
            ->settings(UtmSettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    public function registeringPackage()
    {
        $this->app->register(UtmRouteServiceProvider::class);

        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function configurePackage(Package $package): void
    {
        $package->name('utm')->hasViews()->hasConfigFile();
    }
}
