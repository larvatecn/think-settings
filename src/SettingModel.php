<?php

declare (strict_types=1);

namespace larva\settings;

use think\Model;

/**
 * 配置表
 * @property int $id
 * @property string $key
 * @property string $value
 * @property string $cast_type
 * @property array $options
 * @property string $updated_at
 */
class SettingModel extends Model
{
    /**
     * 模型名称
     * @var string
     */
    protected $name = 'settings';

    /**
     * 字段类型定义
     * @var string[]
     */
    protected $type = [
        'id' => 'integer',
        'key' => 'string',
        'value' => 'string',
        'cast_type' => 'string',
        'options' => 'array',
        'updated_at' => 'datetime'
    ];

    /**
     * 创建时间字段 false表示关闭
     * @var false|string
     */
    protected $createTime = false;

    /**
     * 更新时间字段 false表示关闭
     * @var false|string
     */
    protected $updateTime = 'updated_at';

    /**
     * @return string 获取当前时间
     */
    public function freshTimestamp(): string
    {
        return $this->formatDateTime('Y-m-d H:i:s.u');
    }
}