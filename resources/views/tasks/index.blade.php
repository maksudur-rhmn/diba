@extends('layouts.dashboard')

@section('title')
    ANA | Task Management
@endsection

@section('tasks-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Assign Task</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Assign Task</li>
</ol>
@endsection

@section('content')
{{-- Success Alert --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
<h5 class="text-dark">
        
            {{ session('success') }}
            
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Success Alert --}}

{{-- Error Alert --}}
@if($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<h5 class="text-dark">
        
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
            
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Error Alert --}}

{{-- Warning Alert --}}
@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<h5 class="text-dark">
    {{ session('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</h5>
</div>
@endif
{{-- Warning Alert --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Assign Tasks to individual user</h5>
                    </div>
                    @hasrole('Admin|Moderator')
                    <div class="card-box">
                    <form action="{{ route('tasks.store') }}" class="form-group" method="POST">
                        @csrf 
                        <div class="py-3">
                            <label for="tasks">Required Tasks</label>
                            <input id="tasks" type="text" class="form-control" name="tasks" placeholder="Required Tasks">     
                        </div> 
                        <div class="py-3">
                            <label for="task_description">Task Description</label>
                            <textarea class="form-control" name="task_description" id="task_description" placeholder="Enter Task Description"></textarea>
                        </div>
                        <div class="py-3">
                            <label for="roles">Assign to:</label>
                            <select name="user_id" id="roles" class="form-control">
                                <option value="">-Assign Tasks to-</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="py-3">
                            <label for="datepicker-autoclose">Deadline</label>
                            <input type="date" class="form-control" id="datepicker-autoclose" name="deadline">
                        </div>
                        <div class="py-3">
                            <button class="btn btn-primary" type="submit">Assign Task</button>
                        </div>
                    </form>
                    </div>
                    @else 
                    <h5 class="p-3">Only Admin & Mod's can assign tasks to the user. Please contact the authorities to acquire access. Thank you</h5>
                    @endhasrole
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Assign Tasks via Role</h5>
                    </div>
                    @hasrole('Admin|Moderator')
                    <div class="card-box">
                    <form action="{{ route('tasks.store') }}" class="form-group" method="POST">
                        @csrf 
                        <div class="py-3">
                            <label for="tasks">Required Tasks</label>
                            <input id="tasks" type="text" class="form-control" name="tasks" placeholder="Required Tasks">     
                        </div> 
                        <div class="py-3">
                            <label for="task_description">Task Description</label>
                            <textarea class="form-control" name="task_description" id="task_description" placeholder="Enter Task Description"></textarea>
                        </div>
                        <div class="py-3">
                            <label for="roles">Assign to:</label>
                            <select name="roles" id="roles" class="form-control">
                                <option value="">-Assign Tasks to-</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="py-3">
                            <label for="datepicker-autoclose">Deadline</label>
                            <input type="date" class="form-control" id="datepicker-autoclose" name="deadline">
                        </div>
                        <div class="py-3">
                            <button class="btn btn-primary" type="submit">Assign Task</button>
                        </div>
                    </form>
                    </div>
                    @else 
                    <h5 class="p-3">Only Admin & Mod's can assign tasks to the user. Please contact the authorities to acquire access. Thank you</h5>
                @endhasrole
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 py-5" id="completeD">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="class-title">Submit Tasks (Submit tasks which are assigned to users)</h5>
                        </div>
                        <div class="card-box">
                            {{-- Fail Alert --}}
                            @if (session('failedfromuser'))
                                    <div class="alert alert-danger">
                                        {{ session('failedfromuser') }}
                                    </div>
                             @endif
                            <form action="{{ route('tasks.completedFromUsrers') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="py-3">
                                    <label for="task">Select a task for submission</label>
                                    <select name="task_id" id="task" class="form-control">
                                        <option value="">-Select Tasks-</option>
                                        @foreach ($tasksFromUsers as $task)
                                            <option value="{{ $task->id }}">{{ $task->tasks }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="py-3">
                                    <label for="task_completion">Task completion description</label>
                                    <textarea name="task_completion" id="task_completion" class="form-control" placeholder="Describe your completed task"></textarea>
                                </div>
                                <div class="py-3">
                                    <label for="files">Attach Files (Optional)</label>
                                    <input name="task_file" type="file" class="form-control">
                                </div>
                                <div class="py-3">
                                    <button type="submit" class="btn btn-primary">Submit Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6 py-5" id="completed">
                <div class="card">
                    <div class="card-header">
                        <h5 class="class-title">Submit Tasks (Submit tasks which are assigned to roles)</h5>
                    </div>
                    <div class="card-box">
                        @if (session('failedfromrole'))
                           <div class="alert alert-danger">
                               {{ session('failedfromrole') }}
                           </div>
                        @endif
                        <form action="{{ route('tasks.completedFromRoles') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="py-3">
                                <label for="task">Select a task for submission</label>
                                <select name="task_id" id="task" class="form-control">
                                    <option value="">-Select Tasks-</option>
                                    @foreach ($tasksFromRoles as $task)
                                        <option value="{{ $task->id }}">{{ $task->tasks }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="py-3">
                                <label for="task_completion">Task completion description</label>
                                <textarea name="task_completion" id="task_completion" class="form-control" placeholder="Describe your completed task"></textarea>
                            </div>
                            <div class="py-3">
                                <label for="files">Attach Files (Optional) (Multiple files can be attached)</label>
                                <input type="file" class="form-control" name="task_file">
                            </div>
                            <div class="py-3">
                                <button type="submit" class="btn btn-primary">Submit Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
