<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $lists = ToDoList::where('user_id', auth()->user()->id)->get();
        return view('lists.index')
            ->with('lists', $lists);
    }
    public function show(ToDoList $toDoList)
    {
        $this->authorize('show-list',arguments: $toDoList);
        return view('lists.show')->with('list', $toDoList);
    }
    public function create()
    {
        return view('lists.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:25',
            'description' => 'required|string|max:250'
        ]);
        $user_id = auth()->user()->id;
        $data = $request->except(['_token']);
        $data['user_id'] = $user_id;
        ToDoList::create($data);
        return redirect()->route('lists.index');
    }
    public function delete(ToDoList $toDoList)
    {
        $this->authorize('delete-list',arguments: $toDoList);

        $toDoList->delete();
        return back();
    }
}
