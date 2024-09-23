<?php

namespace Database\Seeders;

use App\Models\ToDoList;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users=User::factory(10)->create();
        foreach($users as $user)
        {
            for ($i=1; $i < rand(1,3) ; $i++)
            {
                $list=ToDoList::factory()->hasTasks(rand(1,max: 5),['user_id' => $user->id,]
                )->create(['user_id'=>$user->id]);
            }
        }

    }
}
