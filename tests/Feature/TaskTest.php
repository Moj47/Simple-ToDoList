<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Models\ToDoList;
use Database\Seeders\DatabaseSeeder;
use Hamcrest\Core\IsTypeOf;
use Hamcrest\Type\IsString;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function testSeeTaskInShowPage()
    {
        $seeder = new DatabaseSeeder();
        $seeder->run();
        $user = User::inRandomOrder()->first();
        $list = $user->toDoLists()->inRandomOrder()->first();
        $tasks = $list->tasks();
        $this->actingAs($user)->get(route('lists.show', ['toDoList' => $list->id]))
            ->assertSuccessful()
            ->assertViewHas('list.tasks')
            ->assertViewHasAll(['list.tasks', 'list.name']);
    }
    public function testMakeATaskWithStoreMethod()
    {
        $user = User::factory()->create();
        $list = ToDoList::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->make([
            'user_id' => $user->id
        ]);
        unset($task->to_do_list_id);
        $data = array_merge($task->toArray(), ['list_id' => $list->id]);
        // dd(is_string($data['description']));
        $this->actingAs($user)
            ->post(route('tasks.store', $data))
            ->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'title' => $data['title']
        ]);
    }
    public function testUpdateTaskWithUpdateMethod()
    {
        $user = User::factory()->create();
        $list = ToDoList::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'to_do_list_id' => $list->id
        ]);
        //check task is false
        $check = Task::where('user_id', $user->id)->first()->check;
        $this->assertEquals($check, 0);
        $this->actingAs($user)
            ->put(route('tasks.update', $task))
            ->assertRedirect();
        //Now check task is true
        $check = Task::where('user_id', $user->id)->first()->check;
        $this->assertEquals($check, 1);

    }
    public function testDeleteAtaskWithDestroyMethod()
    {
        $user = User::factory()->create();
        $list = ToDoList::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create([
            'user_id' => $user->id,
            'to_do_list_id' => $list->id
        ]);
        $this->assertDatabaseHas('tasks', [
            'title' => $task['title']
        ]);
        $this->actingAs($user)
            ->delete(route('tasks.destroy', $task ))
            ->assertRedirect();
        $this->assertDatabaseMissing('tasks',[
            'title'=>$task['title']
        ]);

    }
}
