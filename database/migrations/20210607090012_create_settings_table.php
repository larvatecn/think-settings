<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateSettingsTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('settings', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn(Column::bigInteger('id')->setUnsigned()->setUnique()->setIdentity(true)->setNull(false)->setComment('ID'))
            ->addColumn(Column::string('key')->setUnsigned()->setComment('Key'))
            ->addColumn(Column::text('value')->setNullable()->setComment('Value'))
            ->addColumn(Column::timestamp('updated_at')->setDefault('CURRENT_TIMESTAMP')->setComment('更新时间'))
            ->create();
    }
}
