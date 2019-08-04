<?php

use yii\db\Migration;

/**
 * Class m190803_181247_create_table_rental
 */
class m190803_181247_create_table_rental extends Migration
{
    /**
     * {@inheritdoc}
     * Creates database table for store rentals and setup foreign keys.
     */
    public function safeUp()
    {
        //Create table rental
        $this->createTable('rental', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'car_id' => $this->integer(),
            'rent_start' => $this->timestamp(),
            'rent_end' => $this->timestamp(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_at' => $this->timestamp(),
            'comment' => $this->text(),
        ],
            'ENGINE InnoDB'
        );

        // add foreign key for table `rental` and `user`
        $this->addForeignKey(
            'fk_rental_user_user_id',
            'rental',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `rental` and `car`
        $this->addForeignKey(
            'fk_rental_car_car_id',
            'rental',
            'car_id',
            'car',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     * Removes user table from database.
     */
    public function safeDown()
    {
        $this->dropTable('rental');
    }
}
