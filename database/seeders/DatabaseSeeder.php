<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;
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
        User::factory(10)
            ->has(Task::factory()
                    ->for(Card::factory()
                        ->for(Client::factory()))
                    ->for(User::factory(), 'executor')
                ->count(5), 'tasksCreated')
            ->create();

        Client::factory(10)
            ->has(Task::factory()
                ->for(Card::factory()
                    ->for(Client::factory()))
                ->for(User::factory(), 'executor')
                ->count(5), 'tasks')
            ->create();
    }
}
