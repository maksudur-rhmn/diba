<?php

namespace App\Http\Controllers;

use Auth;
use App\Task;
use App\User;
use Carbon\Carbon;
use App\TaskComplete;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\TaskPostRequest;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tasks.index',[
            'roles' => Role::all(),
            'users' => User::orderBy('name', 'asc')->get(),
            'tasksFromRoles' => Task::whereNotNull('roles')->where('status', '!=' , 'completed')->get(),
            'tasksFromUsers' => Task::whereNotNull('user_id')->where('status', '!=', 'completed')->get(),
        ]);
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
    public function store(TaskPostRequest $request)
    {
       Task::create($request->except('_token') + ['created_at' => Carbon::now()]);
       return back()->withSuccess('Task has been assigned and the user has been notified');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    // All Tasks

    public function all()
    {
        
        return view('tasks.all',[

            'upcomingTasks'   => Task::where('status', 'upcoming')->get(),
            'inProgressTasks' => Task::where('status', 'in progress')->get(),
            'completedTasks'  => Task::where('status', 'completed')->get(),

        ]);
    }

    // Start the Task 
    public function taskStart($task_id)
    {
        Task::findOrFail($task_id)->update([
            'status' => 'in progress',
        ]);
        return back()->withSuccess('Task in progress');
    }

    // Notifications seen 

    public function seen($task_id)
    {
        Task::findOrFail($task_id)->update([
            'is_notified' => 'seen',
        ]);

        return redirect('/tasks/my/unique');
    }
    // Notifications seen Admin

    public function seenfromadmin($task_id)
    {
        TaskComplete::findOrFail($task_id)->update([
            'is_notified' => 'seen',
        ]);

        return redirect('/tasks/all/list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    // Task Submission Via Roles
    
    public function completedFromRoles(Request $request)
    {
        // Get user Role in a collection

        $userRoles = Auth::user()->getRoleNames();
        
        foreach ($userRoles as $userRole) 
        {

            $assigned =  Task::where('id', $request->task_id)->first();

        // Return back if the specific role is not assigned to the task
            if($assigned->roles  != $userRole)
            {
                return back()->withFailedfromrole('Your role is not assigned for this task.Please select a task which your role is assigned to. Thank you');
            }
            // Proceed to submit 
    
            $completion_id = TaskComplete::insertGetId([
    
                'task_id'          => $request->task_id,
                'task_completion'  => $request->task_completion, 
                'roles'            => $userRole,
                'created_at'       => Carbon::now(),
            ]);

            // Check if submission has any files
            if($request->hasFile('task_file'))
            {
                $task_file = $request->file('task_file');
                $task_file_name = str_replace(' ', '', $completion_id). '_task_sub.' .$task_file->extension();
                $new_loc = public_path('uploads/tasks/');
                $task_file->move($new_loc, $task_file_name);

                // Update filename to the database
                TaskComplete::findOrFail($completion_id)->update([
                    'task_file' => $task_file_name,
                ]);
            }
        }
        // Update The task as completed
        Task::findOrFail($request->task_id)->update([
            'status'  => 'completed',
        ]);

        return back()->withSuccess('Task submitted');
    }

    // Task Submission Via User

    public function completedFromUsers(Request $request)
    {
        
        $assigned = Task::where('id', $request->task_id)->first();

        // Return back if the specific user is not assigned to the task

        if($assigned->user_id != Auth::id())
        {
            return back()->withFailedfromuser('You\'re not assigned for this task.Please select a task which you\'re assigned to. Thank you');
        }
         // Proceed to submit 
    
         $completion_id = TaskComplete::insertGetId([
    
            'task_id'          => $request->task_id,
            'task_completion'  => $request->task_completion, 
            'user_id'          => Auth::id(),
            'created_at'       => Carbon::now(), 
        ]);

        // Check if submission has any files

        if($request->hasFile('task_file'))
        {
            $task_file = $request->file('task_file');
            $task_file_name = str_replace(' ', '', $completion_id). '_task_sub.' .$task_file->extension();
            $new_loc = public_path('uploads/tasks/');
            $task_file->move($new_loc, $task_file_name);

            // Update filename to the database
            TaskComplete::findOrFail($completion_id)->update([
                'task_file' => $task_file_name,
            ]);
        }

        // Update The task as completed
        Task::findOrFail($request->task_id)->update([
            'status'  => 'completed',
        ]);

        return back()->withSuccess('Task submitted');
    }

   // END 
}
