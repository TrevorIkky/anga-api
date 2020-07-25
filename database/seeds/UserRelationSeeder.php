<?php

use App\Models\UserRelation;
use Illuminate\Database\Seeder;

class UserRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relation = array(
            'Mother',
            'Father',
            'Daughter',
            'Son',
            'Guardian',
            'Grandparent'
        );

        foreach ($relation as $key => $value) {
            UserRelation::create([
                'relation'=>$value
            ]);
        }
    }
}
