<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

use larva\settings\contracts\SettingsRepository;

if (!function_exists('settings')) {
    /**
     * Get setting value or object.
     *
     * @param string $key
     * @param string|null $default
     * @return SettingsRepository|mixed
     */
    function settings(string $key = '', string $default = null)
    {
        if (empty($key)) {
            return app()->make(SettingsRepository::class);
        }
        return app()->make(SettingsRepository::class)->get($key, $default);
    }
}