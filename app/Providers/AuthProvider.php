<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('delete-list',function(User $user,ToDoList $list){
            return $user->id==$list->user_id;
        });
        Gate::define('delete-task',function(User $user,Task $task){
            return $user->id==$task->user_id;
        });
        Gate::define('update-task',function(User $user,Task $task){
            return $user->id==$task->user_id;
        });
    }
}
