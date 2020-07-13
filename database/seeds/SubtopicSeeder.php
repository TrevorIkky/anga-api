<?php

use App\Models\Subtopic;
use Illuminate\Database\Seeder;


class SubtopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Subtopic::class,7)->create();
    
    }
}
