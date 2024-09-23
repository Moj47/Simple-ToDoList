<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSeeTaskInShowPage()
    {
        $seeder=new DatabaseSeeder();
        $seeder->run();
        $user = User::inRandomOrder()->first();
        $list=$user->toDoLists()->inRandomOrder()->first();
        $tasks=$list->tasks();
        $this->actingAs($user)->get(route('lists.show', ['toDoList' => $list->id]))
        ->assertSuccessful()
        ->assertViewHas('list.tasks')
        ->assertViewHasAll(['list.tasks', 'list.name']);

    }
}
