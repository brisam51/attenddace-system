<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\helpers\DateHeplers;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Exception;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = task::all();

        return view('task.index', ['tasks' => $tasks]);
    }
    //create function

    public function create()
    {
        return view('task.create');
    }
    //insert  new  record
    public function store(Request $request)
    {
       // dd($request->all());
        //Validate incomming data from request
        $validated = $request->validate([

            'title' => 'required|string|max:255',
            'task_code' => 'required|integer|unique:tasks,task_code',
            'description' => 'required|string|max:255',
            'hourly_wage' => 'required|integer',
        ]);
        $task = new Task(); 
        
             try {
            $task->create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'task_code' => $validated['task_code'],
                'hourly_wage' => $validated['hourly_wage'],

            ]);
            return redirect('tasks/index')->with('success', 'task details created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Error creating task details'.$e->getMessage());
        }
    }
    //edit function
    public function edit($id)
    {
        try {
            $tasks = task::find($id);
            return view('task.edit', ['tasks' => $tasks]);
        } catch (Exception $e) {
            return back()->with('error', 'Error editing task details');
        }
    }
    //update current record
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'task_code' => [
            'required',
            'integer',
            Rule::unique('tasks', 'task_code')->ignore($id),
        ],
            'description' => 'required|max:255|string',
            'hourly_wage' => 'required|integer',
        ]);
       
        try {
            $tasks = Task::find($id);
            $tasks->update($validate);
            return redirect('tasks/index')->with('success', 'task details updated successfully');
    }catch (Exception $e) {
        return back()->with('error', 'Error updating task details'.$e->getMessage());
    }
    }
    //delete function
    public function destroy($id){
        try {
            if (Task::where('id', $id)->exists()) {
                $tasks=Task::find($id);
        $tasks->delete();
        return redirect('tasks/index')->with('success', 'task details deleted successfully');
            }
        }catch (Exception $e) {
            return back()->with('error', 'Error deleting task details'.$e->getMessage());
        }
        
    }
}//end class
