<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 */

declare (strict_types = 1);

namespace larva\settings;

use think\Model;

/**
 * @property int $id
 * @property string $key
 * @property string $value
 */
class SettingModel extends Model
{

    protected $name = 'settings';

}