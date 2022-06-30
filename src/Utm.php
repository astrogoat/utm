<?php

namespace Astrogoat\Utm;

class Utm
{
    public function createNoteAttribute() {
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
                array_push($noteAttribute, [$utmQueryParam => session()->get($utmQueryParam)]);
            }
        }

        // format object string
        $first = str_replace('{', '', json_encode($noteAttribute));
        $second = str_replace('}', '', $first);
        $third = str_replace('"', '\"', $second);
        $fourth = str_replace('[', '{', $third);
        $five = str_replace(']', '}', $fourth);

        return $five;
    }
}
