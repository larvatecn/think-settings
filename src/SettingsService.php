<?php

declare (strict_types = 1);

namespace larva\settings;

use larva\settings\contract\SettingsRepository;

/**
 * 服务提供者
 */
class SettingsService extends \think\Service
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SettingsRepository::class, function () {
            return new SettingsManager($this->app);
        });
    }

    public function boot(): void
    {

    }
}