<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TodoList;
class TodoListSeeder extends Seeder
{
  
    public function run(): void
    {
        TodoList::create(['content'=> 'this is the frist content of the todo list']);
    }
}
