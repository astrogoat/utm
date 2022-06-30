<?php

namespace Astrogoat\Utm\Settings;

use Astrogoat\Utm\Actions\UtmAction;
use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class UtmSettings extends AppSettings
{
    // public string $url;

    public function rules(): array
    {
        return [
            // 'url' => Rule::requiredIf($this->enabled === true),
        ];
    }

    // protected static array $actions = [
    //     UtmAction::class,
    // ];

    // public static function encrypted(): array
    // {
    //     return ['access_token'];
    // }

    public function description(): string
    {
        return 'Interact with Utm.';
    }

    public static function group(): string
    {
        return 'utm';
    }
}
