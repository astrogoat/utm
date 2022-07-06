<?php

namespace Astrogoat\Utm\Providers;

use Astrogoat\Utm\Utm;
use Illuminate\Support\Str;

class Elevar implements Provider
{
    protected \Illuminate\Support\Collection $newParameters;

    protected array $currentParameters;

    public function put(array $utmParameters): static
    {
        $this->currentParameters = session('elevar', []);
        $this->newParameters = collect($utmParameters);

        $hasGclidPresent = $this->newParameters->has('gclid');
        $hasUtmParameters = $this->newParameters->contains(fn ($value, $key) => Str::startsWith($key, 'utm_'));

        if ($hasGclidPresent || $hasUtmParameters) {
            $this->clearGclid();
            $this->clearUtms();
        }

        foreach ($this->newParameters as $key => $value) {
            $this->currentParameters[$key] = $value;
        }

        session()->put('elevar', $this->currentParameters);

        return $this;
    }

    public function clear(): void
    {
        foreach (app(Utm::class)->getSources() as $source) {
            if (session()->has($source)) {
                session()->remove($source);
            }
        }
    }

    private function clearGclid(): void
    {
        $this->currentParameters = array_filter($this->currentParameters, fn ($key) => $key !== 'gclid', ARRAY_FILTER_USE_KEY);
    }

    private function clearUtms(): void
    {
        $utmSources = array_filter(app(Utm::class)->getSources(), function ($source) {
            return Str::startsWith($source, 'utm_');
        });

        $this->currentParameters = array_filter($this->currentParameters, fn ($key) => ! in_array($key, $utmSources), ARRAY_FILTER_USE_KEY);
    }

    public function toArray(): array
    {
        return session('elevar', []);
    }
}
