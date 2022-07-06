<?php

namespace Astrogoat\Utm;

use Astrogoat\Utm\Providers\Provider;
use Astrogoat\Utm\Providers\Elevar;
use Astrogoat\Utm\Settings\UtmSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Manager;

class Utm extends Manager
{
    public function createElevarDriver(): Provider
    {
        return new Elevar();
    }

    public function getSources(): array
    {
        return config('utm.sources', []);
    }

    public function getMatchingRequestSources(Request $request): array
    {
        if (count($request->all()) === 0) {
            return [];
        }

        return array_filter($request->all(), function ($key) {
            return in_array($key, $this->getSources());
        }, ARRAY_FILTER_USE_KEY);
    }

    public function getDefaultDriver()
    {
        return app(UtmSettings::class)->provider ?: 'elevar';
    }
}
