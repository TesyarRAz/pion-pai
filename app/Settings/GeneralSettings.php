<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $logo_app = "";
    public ?string $background_app = "";
    public ?string $background_type = "";

    public static function group(): string
    {
        return 'general';
    }
}