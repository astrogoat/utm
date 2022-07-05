<?php

namespace Astrogoat\Utm;

use Illuminate\Support\Str;
use function Pest\Laravel\put;

class Utm
{
    public function createNoteAttribute(): string
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

        $noteAttribute = [];

        foreach ($utmQueryParams as $utmQueryParam) {
            if (session()->has($utmQueryParam)) {
                $noteAttribute[$utmQueryParam] = session()->get($utmQueryParam);
            }
        }

        return Str::replace('"', '\"', json_encode($noteAttribute));
    }
}
