<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['title','description','to_do_list_id','user_id','check'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function toDoList()
    {
        return $this->belongsTo(ToDoList::class);
    }
}
