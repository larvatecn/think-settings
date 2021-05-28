# think-settings

设置

[![Packagist](https://img.shields.io/packagist/l/larva/think-settings.svg?maxAge=2592000)](https://packagist.org/packages/larva/think-settings)
[![Total Downloads](https://img.shields.io/packagist/dt/larva/think-settings.svg?style=flat-square)](https://packagist.org/packages/larva/think-settings)


## Installation

```bash
composer require larva/think-settings -vv
```


## 使用
```php
\Larva\Settings\Facade\Settings::get('abv');

\Larva\Settings\Facade\Settings::set('abv','123456');
```
