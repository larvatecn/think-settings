<?php

declare (strict_types=1);

use larva\settings\contract\SettingsRepository;

if (!function_exists('settings')) {
    /**
     * Get setting value or object.
     *
     * @param string $key
     * @param mixed|null $default
     * @return SettingsRepository|mixed
     */
    function settings(string $key = '', $default = null)
    {
        if (empty($key)) {
            return app()->make(SettingsRepository::class);
        }
        return app()->make(SettingsRepository::class)->get($key, $default);
    }
}