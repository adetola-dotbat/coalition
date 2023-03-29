<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskManager extends Component
{
    public $tasks, $editTaskManager = false, $taskId='';
    public string $taskText = '';

   
    public function mount()
    {
        $this->selectTodos();
    }

    public function addTask()
    {

        $task = new Task();
        $task->task = $this->taskText;
        $task->completed = false;
        $task->save();

        $this->taskText = '';
        $this->selectTodos();
    }

    public function toggleTodo($id)
    {
        // dd($id);
        $task = Task::where('id', $id)->first();
        if (!$task) {
            return;
        }
        $task->completed = !$task->completed;
        $task->save();
        $this->selectTodos();
    }

    public function deleteTodo($id)
    {
        $todo = Task::where('id', $id)->first();
        if (!$todo) {
            return;
        }
        $todo->delete();
        $this->editTaskManager = false;
        $this->taskText='';
        $this->selectTodos();
    }

    public function edit($task){
        $task= Task::find($task);
        $task->task = $this->taskText;
        return view('livewire.task-manager', compact('task'));

    }
    public function selectTodos()
    {
        $this->tasks = Task::orderBy('position', 'ASC')->get();
    }

    public function render()
    {
        $this->tasks = Task::orderBy('position', 'ASC')->get();
        return view('livewire.task-manager');
    }

    public function priority($items){

         foreach($items as $item):
            $task = Task::find($item['value']);
            $task->position = $item['order'];
            $task->save();
        endforeach;
    }

    public function editTask($task){
        $this->editTaskManager= true;
        $task = Task::findorfail($task);
        $this->taskText = $task->task;
        $this->taskId = $task->id;
    }

    public function updateTask(){
        $task = Task::findorfail($this->taskId);
        $task->update([
            'task' => $this->taskText
        ]);
        $this->selectTodos();
       
    }
}