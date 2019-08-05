<?php

use yii\db\Migration;

/**
 * Class m190803_164423_create_table_user
 */
class m190803_164423_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     * Creates user table for store user informations.
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'email' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'modified_at' => $this->timestamp(),
            'status'=> $this->integer(),
            'is_admin' => $this->boolean(),
        ],
            'ENGINE InnoDB'
        );

    }

    /**
     * {@inheritdoc}
     * Removes user table from database.
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
