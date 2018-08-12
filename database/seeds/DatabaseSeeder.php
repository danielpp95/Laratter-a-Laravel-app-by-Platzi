<?php

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

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // $this->call(UsersTableSeeder::class);
        // Create 50 users
        $users = factory(App\User::class, 50)->create();
        

        $users->each(function(App\User $user) use ($users) {
            // every user has 20 messages
            factory(App\Message::class)->times(20)->create(['user_id' => $user->id,]);

            // every user follow 10 randomusers 
            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
