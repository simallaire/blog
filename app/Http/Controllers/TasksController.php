<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index(){
        $task = Task::all();   
        //  task::completed(); 
        
        return $task;
    }
    public function show(Task $task){
    	return view('tasks/show',compact('task'));
    }
    public function incomplete(){
    	$tasks = Task::incomplete()->get();
    	return $tasks;
    }
    public function create(){
        return view('tasks.create');
    }
    public function store(){
 
        if(request('completed')!=null){
        $tasks = Task::create([
            'body' => request('body'),
            'completed' => request('completed')

        ]);
        }else{
            $tasks = Task::create([
                'body' => request('body'),
                'completed' => 0
    
            ]);
        }
        return redirect()->home();
    }
}
