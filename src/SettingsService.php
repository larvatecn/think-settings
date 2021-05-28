<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

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
    public function register()
    {
        $this->app->bind(SettingsRepository::class, function () {
            return new SettingsManager($this->app);
        });
    }

    public function boot(): void
    {

    }
}