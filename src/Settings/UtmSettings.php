<?php

namespace Astrogoat\Utm\Settings;

use Astrogoat\Utm\Actions\UtmAction;
use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class UtmSettings extends AppSettings
{
    public string $provider;

    public function rules(): array
    {
        return [
            'provider' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public function providerOptions(): array
    {
        return [
            'elevar' => 'Elevar',
        ];
    }

    public function description(): string
    {
        return 'Stores UTM parameters.';
    }

    public static function group(): string
    {
        return 'utm';
    }
}
