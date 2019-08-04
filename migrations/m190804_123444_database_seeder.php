<?php

use yii\db\Migration;

/**
 * Class m190804_123444_database_seeder
 */
class m190804_123444_database_seeder extends Migration
{
    /**
     * {@inheritdoc}
     * Seeding a database is a process in which an initial set of data
     * is provided to a database when it is being installed.
     */
    public function safeUp()
    {

        $this->insert('user', [
            'username' => 'teszt1',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('teszt1'),
            'email' => 'tesz1@elek.hu',
            'is_admin' => '1'
        ]);

        $this->insert('car', [
            'brand' => 'Ford',
            'model' => 'Sierra',
            'year' => 1987,
            'odometer' => 321000,
            'reg_no' => 'frd-001',
            'rate' => 4000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 1986,
            'odometer' => 132000,
            'reg_no' => 'tya-001',
            'rate' => 3000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Toyota',
            'model' => 'Supra',
            'year' => 1986,
            'odometer' => 75000,
            'reg_no' => 'tya-002',
            'rate' => 3000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Honda',
            'model' => 'Civic',
            'year' => 1992,
            'odometer' => 195000,
            'reg_no' => 'hda-001',
            'rate' => 5000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Honda',
            'model' => 'Integra',
            'year' => 1985,
            'odometer' => 285000,
            'reg_no' => 'hda-002',
            'rate' => 7000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Nissan',
            'model' => '180SX',
            'year' => 1998,
            'odometer' => 180000,
            'reg_no' => 'nsn-001',
            'rate' => 6000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Nissan',
            'model' => 'Skyline R32',
            'year' => 1986,
            'odometer' => 232000,
            'reg_no' => 'nsn-002',
            'rate' => 6000,
            'is_broken' => 0,
        ]);

        $this->insert('car', [
            'brand' => 'Subaru',
            'model' => 'Impreza',
            'year' => 1999,
            'odometer' => 155000,
            'reg_no' => 'sbr-001',
            'rate' => 8000,
            'is_broken' => 0,
        ]);

    }

    /**
     * {@inheritdoc}
     * Removes default seeding data.
     */
    public function safeDown()
    {
        $this->delete('user', [
            'username' => 'teszt1',
            ]);

        $this->delete('car', [
            'reg_no' => 'frd-001',
        ]);

        $this->delete('car', [
            'reg_no' => 'tya-001',
        ]);

        $this->delete('car', [
            'reg_no' => 'tya-002',
        ]);

        $this->delete('car', [
            'reg_no' => 'hda-001',
        ]);

        $this->delete('car', [
            'reg_no' => 'hda-002',
        ]);

        $this->delete('car', [
            'reg_no' => 'nsn-001',
        ]);

        $this->delete('car', [
            'reg_no' => 'nsn-002',
        ]);

        $this->delete('car', [
            'reg_no' => 'sbr-001',
        ]);
    }

}
