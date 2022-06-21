<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateUtmSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('utm.enabled', false);
        // $this->migrator->add('utm.url', '');
        // $this->migrator->addEncrypted('utm.access_token', '');
    }

    public function down()
    {
        $this->migrator->delete('utm.enabled');
        // $this->migrator->delete('utm.url');
        // $this->migrator->delete('utm.access_token');
    }
}
