<?php

namespace Tests\Feature;

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
        $user=User::findOrFail(11);
        $list=User::findOrFail(11)->toDoLists()->first();
        $this->actingAs($user)->get(route('lists.show',$list))
        ->assertSuccessful()
        ->assertViewHas('list');
    }
}
