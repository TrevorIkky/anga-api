<?php

use App\Models\Subscription;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SubscriptionSeeder::class);
        $this->call(SubtopicSeeder::class);
        $this->call(ApiListSeeder::class);
    }
}
