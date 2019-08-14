<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('TaskSharing\Entities\User', 50)->create()->each(function ($u) {
            $u->attachRole(11);
        });
    }
}
