<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required|string|max:25',
            'description'=>'required|string|max:25',
        ]);

        $user_id=auth()->user()->id;
        $task=Task::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'to_do_list_id'=>$request->list_id,
            'user_id'=>$user_id
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        if($task->check==true)
            $task->update(['check'=>false]);
        else
            $task->update(['check'=>true]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
