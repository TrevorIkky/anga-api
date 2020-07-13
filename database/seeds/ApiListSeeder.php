<?php

use Illuminate\Database\Seeder;


class ApiListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\ApiList::class,10)->create();

    }
}
