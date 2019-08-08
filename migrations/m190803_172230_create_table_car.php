<?php

use yii\db\Migration;

/**
 * Class m190803_172230_create_table_car
 */
class m190803_172230_create_table_car extends Migration
{
    /**
     * {@inheritdoc}
     * Creates database table for store cars.
     */
    public function safeUp()
    {
        $this->createTable('car', [
            'id' => $this->primaryKey(),
            'brand' => $this->string(),
            'model' => $this->string(),
            'year' => $this->integer(),
            'odometer' => $this->integer(),
            'reg_no' => $this->string(7)->unique(),
            'rate' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_at' => $this->timestamp(),
            'status' => $this->integer()->defaultValue(1),
        ],
            'ENGINE InnoDB'
        );

    }

    /**
     * {@inheritdoc}
     * Removes car table from the database.
     */
    public function safeDown()
    {
        $this->dropTable('car');
    }
}