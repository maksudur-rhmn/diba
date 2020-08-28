<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Auth;

class MyTaskController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
       $this->middleware('verified');
   }

       // Individuals Task 

       public function index()
       {
          return view('tasks.myTask',[
               'taskRoles' => Task::where('roles', userRole())->latest()->paginate(3),
               'taskUser'  => Task::where('user_id', Auth::id())->latest()->paginate(3),
           ]);
       }
}
