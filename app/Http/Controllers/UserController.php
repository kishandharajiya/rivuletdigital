<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdateNotification;
use App\Models\Task;
use App\Models\User;
use App\Notifications\AssignUserMail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $role =  Role::where('name', 'employee')->first();
        $users =$role->users;
        return view('users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $taskList = Task::get();
        return view('users.edit', compact('user','taskList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->assignTask()->create(['task_id' => $request->task_id]);
        $taskName = Task::where('id', $request->task_id)->value('title') ?? "";
        
        // SEND EMAIL NOTIFICATION USING SHOULDQUEUE 
        $user->notify(new AssignUserMail($taskName,$user->name));
        return redirect()->route('users.index') ->with('success', trans('messages.user.task_assigned'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
         $user->delete();
        return redirect()->route('tasks.index')->with('success', trans('messages.user.delete'));
    }
}
