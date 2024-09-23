<?php

namespace Tests\Feature;

use App\Models\ToDoList;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTest extends TestCase
{
    use RefreshDatabase;
    public function testCanSeeAllListsInIndexPage()
    {
        $seeder=new DatabaseSeeder();
        $seeder->run();
        $user=User::findOrFail(1);
        $this->actingAs($user)->get(route('lists.index'))
        ->assertSuccessful()
        ->assertViewHas('lists');
    }
    public function testCanSeeAListInShowPage()
    {
        $seeder=new DatabaseSeeder();
        $seeder->run();
        $user = User::inRandomOrder()->first();
        $list=$user->toDoLists()->inRandomOrder()->first();
        $this->actingAs($user)->get(route('lists.show', ['toDoList' => $list->id]))
        ->assertSuccessful()
        ->assertViewHas('list');
    }
    public function testMakeAListWithStoreMethod()
    {
        $user=User::factory()->create();
        $list=ToDoList::factory()->make(['user_id'=>$user->id]);
        $this->actingAs($user)
        ->post(route('lists.store',$list->toArray()))
        ->assertRedirect();

        $this->assertDatabaseHas('to_do_lists',$list->toArray());
    }
    public function testDeleteAListWitDestroyMethod()
    {
        $user=User::factory()->create();
        $list=ToDoList::factory()->create(['user_id'=>$user->id]);
        $this->assertDatabaseHas('to_do_lists',$list->toArray());
        $this->actingAs($user)
        ->delete(route(name: 'lists.destroy',  parameters: $list))
        ->assertRedirect();
        $this->assertDatabaseMissing('to_do_lists',$list->toArray());
    }
}
