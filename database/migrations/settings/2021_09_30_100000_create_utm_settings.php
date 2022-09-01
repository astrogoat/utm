<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateUtmSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('utm.enabled', false);
        $this->migrator->add('utm.provider', '');
    }

    public function down()
    {
        $this->migrator->delete('utm.enabled');
        $this->migrator->delete('utm.provider');
    }
}
