<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace larva\settings\facade;

use larva\settings\contracts\SettingsRepository;

class Settings extends \think\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeClass(): string
    {
        return SettingsRepository::class;
    }
}