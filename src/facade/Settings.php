<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

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