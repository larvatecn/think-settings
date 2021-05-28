<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */
namespace larva\settings\contract;

use think\Collection;

interface SettingsRepository
{
    /**
     * 获取所有的设置
     * @return Collection
     */
    public function all($reload = false);

    /**
     * 指定的设置是否存在
     *
     * @param string $key
     * @return bool
     */
    public function has($key);

    /**
     * 获取设置
     * @param string $key
     * @param string $default
     * @return string
     */
    public function get($key, $default = null);

    /**
     * 获取设置组
     * @param string $section
     * @return array
     */
    public function section($section);

    /**
     * 保存设置
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value);

    /**
     * 删除设置
     * @param string $key
     * @return mixed
     */
    public function forge($key);
}