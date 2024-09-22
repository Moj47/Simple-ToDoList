<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $lists=ToDoList::where('user_id',auth()->user()->id)->get();
        return view('lists.index')
        ->with('lists',$lists);
    }
    public function show(ToDoList $toDoList)
    {
        return view('lists.show')->with('list',$toDoList);
    }
}
