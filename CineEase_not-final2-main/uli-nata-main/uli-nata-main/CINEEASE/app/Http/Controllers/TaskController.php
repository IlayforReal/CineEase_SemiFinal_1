<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;




class TaskController extends Controller



    {
        public function index(){
            $tasks = Task::all();
            return view ('task.index', ['tasks' => $tasks]);
            
    
        }

    

    public function create(){
        return view ('task.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'completed' => 'required'
        ]);
    
        $newTask = Task::create($data); // Note the capitalization of "Task"
    
        return redirect(route('task.index'));
    }


    public function edit(Task $task ){
        return view ('task.edit', ['task' => $task]); 
      
      
      
  

    }

    public function update(Task $task, Request $request  ){

        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'completed' => 'required'
        ]);
      $task -> update ($data);

      return redirect(route ('task.index')) -> with ('success', 'Task Updated Successfully'); 

    }

    public function destroy (Task $task){
        $task -> delete();
        return redirect(route ('task.index')) -> with ('success', 'Task deleted Successfully'); 

    }

    
    
   
    


    
}