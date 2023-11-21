<?php

declare (strict_types=1);

namespace larva\settings\contract;

use think\Collection;

/**
 * 配置仓库接口
 */
interface SettingsRepository
{
    /**
     * 获取所有的设置
     * @param bool $reload
     * @return Collection
     */
    public function all(bool $reload = false): Collection;

    /**
     * 指定的设置是否存在
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * 获取设置
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * 获取设置组
     * @param string $section
     * @return array
     */
    public function section(string $section): array;

    /**
     * 保存设置
     * @param string $key
     * @param string $value
     * @param string $cast_type
     * @return bool
     */
    public function set(string $key, string $value, string $cast_type = 'string'): bool;

    /**
     * 删除设置
     * @param string $key
     * @return bool
     */
    public function forge(string $key): bool;
}