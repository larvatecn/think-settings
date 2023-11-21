<?php

declare (strict_types = 1);

namespace larva\settings\facade;

use larva\settings\contract\SettingsRepository;
use think\Facade;

/**
 * Settings 门面
 */
class Settings extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeClass(): string
    {
        return SettingsRepository::class;
    }
}