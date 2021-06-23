<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types = 1);

namespace larva\settings;

use Exception;
use larva\settings\contract\SettingsRepository;
use think\App;
use think\Collection;
use think\facade\Cache;
use think\facade\Log;
use think\helper\Arr;

/**
 * 配置管理
 */
class SettingsManager implements SettingsRepository
{
    const CACHE_TAG = 'settings';

    /**
     * The container instance.
     *
     * @var App
     */
    protected $app;

    /**
     * @var Collection
     */
    protected $settings = null;

    /**
     * Create a new instance.
     *
     * @param App $app
     * @return void
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * 获取所有的设置
     * @param bool $reload
     * @return Collection
     * @throws \think\Exception
     */
    public function all(bool $reload = false): Collection
    {
        if (($settings = Cache::get(static::CACHE_TAG)) == null || $reload) {
            $settings = [];
            try {
                SettingModel::select()->each(function ($setting) use (&$settings) {
                    switch ($setting['cast_type']) {
                        case 'integer':
                            $value = (int) $setting['value'];
                            break;
                        case 'float':
                            if (empty($param)) {
                                $value = (float) $setting['value'];
                            } else {
                                $value = (float) number_format($setting['value'], (int) $param, '.', '');
                            }
                            break;
                        case 'boolean':
                            $value = (bool) $setting['value'];
                            break;
                        default:
                            $value = $setting['value'];
                    }
                    Arr::set($settings, $setting['key'], $value);
                });
                Cache::set(static::CACHE_TAG, $settings, 7200);
            } catch (Exception $exception) {
                if ($this->app->isDebug()) {
                    throw new \think\Exception('配置读取错误', 500, $exception);
                } else {
                    Log::error('配置读取错误：' . $exception->getMessage());
                    Log::error('配置读取错误通常情况是 settings 数据表不存在，或者表结构不符合才会发生。当然如果数据库连接不上也是可能的。');
                }
            }
        }

        $this->settings = collect($settings);
        return $this->settings;
    }

    /**
     * 指定的设置是否存在
     *
     * @param string $key
     * @return bool
     * @throws \think\Exception
     */
    public function has(string $key): bool
    {
        return Arr::has($this->all(), $key);
    }

    /**
     * 获取设置
     * @param string $key
     * @param mixed|null $default
     * @return string
     * @throws \think\Exception
     */
    public function get(string $key, $default = null): string
    {
        return Arr::get($this->all(), $key, $default);
    }

    /**
     * 获取设置组
     * @param string $section
     * @return array
     * @throws \think\Exception
     */
    public function section(string $section):array
    {
        return Arr::get($this->all(), $section);
    }

    /**
     * 保存设置
     * @param string $key
     * @param string $value
     * @return bool
     * @throws \think\Exception
     */
    public function set(string $key, string $value):bool
    {
        if (is_array($value)) {
            return false;
        }
        //写库
        $setting = SettingModel::where('key', $key)->find();
        if ($setting != null) {
            $setting->save(compact('value'));
        } else {
            SettingModel::create(compact('key', 'value'));
        }
        $this->all(true);//重载
        return true;
    }

    /**
     * 删除设置
     * @param string $key
     * @return true
     * @throws \think\Exception
     */
    public function forge(string $key):bool
    {
        SettingModel::where('key', $key)->delete();
        $this->all(true);//重载
        return true;
    }
}