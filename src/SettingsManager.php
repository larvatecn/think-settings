<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

namespace larva\settings;

use larva\settings\contract\SettingsRepository;
use think\App;
use think\Collection;
use think\facade\Cache;
use think\helper\Arr;

/**
 * Class SettingsManager
 * @author Tongle Xu <xutongle@msn.com>
 * @date 2021/5/28
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
     * @return Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function all($reload = false)
    {
        if (($settings = Cache::get(static::CACHE_TAG)) == null || $reload) {
            $settings = [];
            SettingModel::select()->each(function ($setting) use (&$settings) {
                Arr::set($settings, $setting['key'], $setting['value']);
            });
            Cache::set(static::CACHE_TAG, $settings, 7200);
        }

        $this->settings = collect($settings);
        return $this->settings;
    }

    /**
     * 指定的设置是否存在
     *
     * @param string $key
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function has($key)
    {
        return Arr::has($this->all(), $key);
    }

    /**
     * 获取设置
     * @param string $key
     * @param null $default
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->all(), $key, $default);
    }

    /**
     * 获取设置组
     * @param string $section
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function section($section)
    {
        return Arr::get($this->all(), $section);
    }

    /**
     * 保存设置
     * @param string $key
     * @param string $value
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function set($key, $value)
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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function forge($key)
    {
        SettingModel::where('key', $key)->delete();
        $this->all(true);//重载
        return true;
    }
}