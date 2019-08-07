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
        //insert users
        $this->insert('user', [
            'username' => 'teszt1',
            'password' => Yii::$app->security->generatePasswordHash('teszt1'),
            'email' => 'teszt1@elek.hu',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'role' => 1,
        ]);

        $this->insert('user', [
            'username' => 'teszt2',
            'password' => Yii::$app->security->generatePasswordHash('teszt2'),
            'email' => 'teszt2@elek.hu',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'role' => 0,
        ]);

        //insert cars
        $this->insert('car', [
            'brand' => 'Ford',
            'model' => 'Sierra',
            'year' => 1987,
            'odometer' => 321000,
            'reg_no' => 'frd-001',
            'rate' => 4000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 1986,
            'odometer' => 132000,
            'reg_no' => 'tya-001',
            'rate' => 3000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Toyota',
            'model' => 'Supra',
            'year' => 1986,
            'odometer' => 75000,
            'reg_no' => 'tya-002',
            'rate' => 3000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Honda',
            'model' => 'Civic',
            'year' => 1992,
            'odometer' => 195000,
            'reg_no' => 'hda-001',
            'rate' => 5000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Honda',
            'model' => 'Integra',
            'year' => 1985,
            'odometer' => 285000,
            'reg_no' => 'hda-002',
            'rate' => 7000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Nissan',
            'model' => '180SX',
            'year' => 1998,
            'odometer' => 180000,
            'reg_no' => 'nsn-001',
            'rate' => 6000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Nissan',
            'model' => 'Skyline R32',
            'year' => 1986,
            'odometer' => 232000,
            'reg_no' => 'nsn-002',
            'rate' => 6000,
            'status' => 1,
        ]);

        $this->insert('car', [
            'brand' => 'Subaru',
            'model' => 'Impreza',
            'year' => 1999,
            'odometer' => 155000,
            'reg_no' => 'sbr-001',
            'rate' => 8000,
            'status' => 1,
        ]);

        //insert rental
        $this->insert('rental',[
            'user_id' => 1,
            'car_id' => 1,
            'rent_start' => '2019-08-04 00:01:00',
            'rent_end' => '2019-08-04 23:59:00',
            'comment' => 'Database seeder rental test No.1',
        ]);

        $this->insert('rental',[
            'user_id' => 2,
            'car_id' => 2,
            'rent_start' => '2019-08-05 00:01:00',
            'rent_end' => '2019-08-05 23:59:00',
            'comment' => 'Database seeder rental test No.2',
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

        $this->delete('user', [
            'username' => 'teszt2',
        ]);

        $this->delete('rental',[
            'car_id' => 1,
            'comment' => 'Database seeder rental test No.1',
        ]);

        $this->delete('rental',[
            'car_id' => 2,
            'comment' => 'Database seeder rental test No.2',
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
