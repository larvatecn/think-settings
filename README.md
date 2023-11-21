# think-settings

适用于 ThinkPHP 6/8 的设置扩展，移植 https://github.com/larvatecn/laravel-settings

[![Packagist](https://img.shields.io/packagist/l/larva/think-settings.svg?maxAge=2592000)](https://packagist.org/packages/larva/think-settings)
[![Total Downloads](https://img.shields.io/packagist/dt/larva/think-settings.svg?style=flat-square)](https://packagist.org/packages/larva/think-settings)


## 安装

```bash
composer require larva/think-settings -vv
```

## 配置

复制 'vendor/larva/think-settings/database/migrations' 文件夹下的迁移文件到你的迁移文件目录后执行迁移即可。

## 使用
```php
\larva\settings\facade\Settings::has('abv');//判断是否存在

\larva\settings\facade\Settings::get('abv');//获取
\larva\settings\facade\settings::set('abv','123456');//设置
\larva\settings\facade\settings::set('abv','1','bool');//设置 bool 类型

\larva\settings\facade\settings::set('aliyun.appid','123456');//设置配置组
\larva\settings\facade\Settings::get('aliyun.appid');//获取配置组里的

\larva\settings\facade\settings::section('aliyun');//直接获取一个配置组

以上两个方法的结果也可以使用 `settings(string $key = '', string $default = null)` 获取同样的结果
直接使用 `settings()` 空参数也可以获取到 `\larva\settings\facade\settings` 的实例；

```
