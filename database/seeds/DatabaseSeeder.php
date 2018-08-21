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
        // create 20 users
        $users = factory(App\User::class, 20)->create();

        $users->each(function(App\User $user) use ($users) {
            // each user has 10 messages
            $messages = factory(App\Message::class)
            	->times(10)
                ->create([
                    'user_id' => $user->id,
                ]);

            // each message has 1-3 responses
            $messages->each(function (App\Message $message) use ($users) {
                factory(App\Response::class, random_int(1, 3))->create([
                    'message_id' => $message->id,
                    'user_id' => $users->random(1)->first()->id,
                ]);
            });

            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
