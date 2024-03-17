<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdateNotification;
use App\Http\Requests\Task\ChangeStatus;
use App\Http\Requests\Task\Store;
use App\Http\Requests\Task\Update;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
        $this->middleware('permission:change-task-status', ['only' => ['changeStatusPage','changeStatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // GET EMPLOYEE ADDED TASK ONLY
        if(auth()->user()->getRoleNames()->first() == 'employee'){
            $tasks =  auth()->user()->tasks()->paginate(5);
            return view('tasks.index', compact('tasks'))->with('i', (request()->input('page', 1) - 1) * 5);
        }
        // FOR ADMIN & MANAGER
        $tasks = Task::latest()->paginate(5);
        return view('tasks.index', compact('tasks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        Auth::user()->tasks()->create($request->validated());
        return redirect()->route('tasks.index')->with('success', trans('messages.task.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Task $task)
    {
        $task->update($request->validated());

        // SEND WEB NOTIFICATION USING EVENTS
        $msg = trans('messages.task.tast_update', ['employee' => auth()->user()->name]);
        event(new TaskUpdateNotification($msg));
        
        return redirect()->route('tasks.index') ->with('success', trans('messages.task.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', trans('messages.task.delete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function changeStatusPage(Request $request,Task $task)
    {
        return view('tasks.change-status', compact('task'));
    }

     
     /**
      * Change Status
      *
      * @param  mixed $request
      * @param  mixed $task
      * @return void
      */
     public function changeStatus(ChangeStatus $request, Task $task)
    {
  //      dd($request->all());
        $task->update($request->validated());
        return redirect()->route('tasks.index') ->with('success', trans('messages.task.status_change'));
    }
    
}
