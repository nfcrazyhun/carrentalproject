<?php

use yii\db\Migration;

/**
 * Class m190803_181247_create_table_rental
 */
class m190803_181247_create_table_rental extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rental', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string(),
            'car_id' => $this->string(),
            'rent_start' => $this->timestamp(),
            'rent_end' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_at' => $this->timestamp(),
            'comment' => $this->text(),
        ],
            'ENGINE InnoDB'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rental');
    }
}
