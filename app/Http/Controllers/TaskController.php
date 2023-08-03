<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use App\Mail\TaskCompletedNotification;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {

         $tasks = Tasks::all();


         return view('tasks.index', compact('tasks'));
     }

     public function create()
     {

         return view('tasks.create');
     }

     public function store(Request $request)
     {

         $request->validate([
             'title' => 'required',
             'completed' => 'boolean',
         ]);


         $task = Tasks::create([
             'title' => $request->title,
             'completed' => $request->has('completed'),
         ]);


         return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
     }

     public function edit(Tasks $task)
     {

         return view('tasks.edit', compact('task'));
     }

     public function update(Request $request, Tasks $task)
     {

         $request->validate([
             'title' => 'required',
             'completed' => 'boolean',
         ]);


         $task->update([
             'title' => $request->title,
             'completed' => $request->has('completed'),
         ]);

         if ($task->completed) {
            // Send email notification to admin
            Mail::to('taghizadehamirhosein9@gmail.com')->send(new TaskCompletedNotification($task));
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');



     }

     public function destroy(Tasks $task)
     {

         $task->delete();

         return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
     }
}
