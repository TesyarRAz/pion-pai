<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.logo_app', '');
        $this->migrator->add('general.background_app', '');
        $this->migrator->add('general.background_type', '');
        $this->migrator->add('general.corp_gambar', '');
    }
};
