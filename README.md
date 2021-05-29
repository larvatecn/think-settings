# think-settings

适用于 ThinkPHP 6 的设置扩展，移植 https://github.com/larvatecn/laravel-settings

[![Packagist](https://img.shields.io/packagist/l/larva/think-settings.svg?maxAge=2592000)](https://packagist.org/packages/larva/think-settings)
[![Total Downloads](https://img.shields.io/packagist/dt/larva/think-settings.svg?style=flat-square)](https://packagist.org/packages/larva/think-settings)


## 安装

```bash
composer require larva/think-settings -vv
```

## 配置

这个模块无需配置，但是由于 thinkphp 没有自带的发布资源的接口，所以你需要自建一个数据表，`settings` （自行搞定你的表前缀，本扩展用的是模型连接的数据库，所以可以支持表前缀）；

| 字段        | 类型   |  描述  |
| --------   | -----:  | :----:  |
| id      | int   |   自增主键     |
| key        |   string(100)   |   配置项   |
| value        |    text    |  配置值  |
| updated_at        |    datetime    |  更新时间  |

## 使用
```php
\larva\settings\facade\Settings::has('abv');//判断是否存在

\larva\settings\facade\Settings::get('abv');//获取
\larva\settings\facade\settings::set('abv','123456');//设置

\larva\settings\facade\settings::set('aliyun.appid','123456');//设置配置组
\larva\settings\facade\Settings::get('aliyun.appid');//获取配置组里的

\larva\settings\facade\settings::section('aliyun');//直接获取一个配置组

以上两个方法的结果也可以使用 `settings(string $key = '', string $default = null)` 获取同样的结果
直接使用 `settings()` 空参数也可以获取到 `\larva\settings\facade\settings` 的实例；

```
