<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{

    public $newTodo;

    public function render()
    {
        $todos = Todo::all();

        return view('livewire.todo-list',
            [
                'todos' => $todos
            ]
        );
    }

    public function addTodo()
    {
        Todo::create([
            'user_id' => 1,
            'to' => 1,
            'todo' => $this->newTodo,
            'done' => false
        ]);

        $this->newTodo = '';
    }

    public function removeTodo($todo)
    {
        $validated = Todo::findOrFail($todo);

        $validated->destroy($todo);
    }

    public function toggleDone($todo)
    {
        $validated = Todo::findOrFail($todo);

        $validated->update([
            'done' => !$validated->done
        ]);
    }
}
