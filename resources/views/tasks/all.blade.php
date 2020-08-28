@extends('layouts.dashboard')

@section('title')
    ANA | Task Management
@endsection

@section('taskboard-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Taskboard</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Taskboard</li>
</ol>
@endsection

@section('content')
    
<div class="row">
    <div class="col-lg-4">
        <div class="card-box">
            @hasrole('Admin|Moderator')
            <a href="{{ route('tasks.index') }}" class="pull-right btn btn-secondary btn-sm waves-effect waves-light">Add New</a>
            @endhasrole
            <h4 class="text-dark header-title m-t-0">Upcoming</h4>
            <p class="text-muted m-b-30 font-13">
                List of all the upcoming tasks.
            </p>

            <ul class="sortable-list taskList list-unstyled" id="upcoming">
                @php
                    $flag = 1;
                @endphp
                @forelse ($upcomingTasks as $upcomingTask)
                <li class="task-warning" id="task">
                    <h5>{{ $upcomingTask->tasks }}</h5>
                    <p>Deadline : {{ \Carbon\Carbon::parse($upcomingTask->deadline)->format('d-M-Y') }}</p>
                    <div class="clearfix"></div>
                    <div class="m-t-20">
                        <p class="pull-right m-b-0 m-t-10">
                            <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#task-detail-modal{{ $flag }}">View</button>
                            @if($upcomingTask->roles == userRole() || $upcomingTask->user_id == Auth::id())
                              <a href="" class="btn btn-warning btn-xs waves-effect waves-light">Start task</a>
                            @endif
                        </p>
                        <p class="m-b-0"><a href="{{ ($upcomingTask->roles) ? '#' : route('users.show', $upcomingTask->user_id) }}" class="text-muted"><img src="{{ ($upcomingTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $upcomingTask->getUser->profile_picture)  }}" alt="task-user" class="thumb-sm rounded-circle m-r-10"> <span class="font-bold font-secondary">{{ $upcomingTask->roles ?? $upcomingTask->getUser->name }}</span></a> </p>
                    </div>
                </li>

                                <!-- Modal -->
                <div id="task-detail-modal{{ $flag }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">

                                <div class="p-10 task-detail">
                                    <div class="media m-t-0 m-b-20">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ ($upcomingTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $upcomingTask->getUser->profile_picture)  }}" alt="Generic placeholder image" height="48">
                                        <div class="media-body">
                                            <h5 class="media-heading m-b-5 mt-0">{{ $upcomingTask->roles ?? $upcomingTask->getUser->name }}</h5>
                                            <span class="label label-danger">{{ $upcomingTask->status }}</span>
                                        </div>
                                    </div>

                                    <h4 class="font-600 m-b-20">{{ $upcomingTask->tasks }}</h4>
                                    <ul class="list-inline task-dates m-b-0 m-t-20">
                                        <li>
                                            <h5 class="font-600 m-b-5">Start Date</h5>
                                            <p>{{ $upcomingTask->created_at->format('d-M-Y') }}</p>
                                        </li>

                                        <li>
                                            <h5 class="font-600 m-b-5">Due Date</h5>
                                            <p> 
                                                {{ \Carbon\Carbon::parse($upcomingTask->deadline)->format('d-M-Y') }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>

                                    <div class="task-tags m-t-20">
                                        <h5 class="font-600">Description</h5>
                                        <h6>{{ $upcomingTask->task_description }}</h6>
                                    </div>
                                    <div class="attached-files m-t-30">
                                        <h5 class="font-600">Attached Files </h5>
                                        <div class="files-list">
                                            @if($upcomingTask->status == 'completed')
                                                <div class="file-box">
                                                    <a href="{{ asset('uploads/tasks') }}/{{ $upcomingTask->getFiles->task_file }}">Download files</a>
                                                    <p class="font-13 m-b-5 text-muted"><small>File one</small></p>
                                                </div>
                                            @else 
                                             <p>No files attached yet.</p>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Go back</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @php
                    $flag++;
                @endphp
                @empty 
                 <h5>No upcoming tasks.</h5>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">In Progress</h4>
            <p class="text-muted m-b-30 font-13">
               Lists of all the tasks in progress
            </p>

            <ul class="sortable-list taskList list-unstyled" id="inprogress">
                @forelse ($inProgressTasks as $inProgressTask)        
                <li class="task-info" id="task">
                    <h5>{{ $inProgressTask->tasks }}</h5>
                    <p>Deadline : {{ \Carbon\Carbon::parse($inProgressTask->deadline)->format('d-M-Y') }}</p>
                    <div class="clearfix"></div>
                    <div class="m-t-20">
                        <p class="pull-right m-b-0 m-t-10">
                            <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#task-detail-modal{{ $flag }}">View</button>
                        </p>
                        <p class="m-b-0"><a href="" class="text-muted"><img src="{{ ($inProgressTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $inProgressTask->getUser->profile_picture)  }}" alt="task-user" class="thumb-sm rounded-circle m-r-10"> <span class="font-bold font-secondary">{{ $inProgressTask->roles ?? $inProgressTask->getUser->name }}</span></a> </p>
                    </div>
                </li>
                        <!-- Modal -->
                        <div id="task-detail-modal{{ $flag }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <div class="modal-body">
    
                                    <div class="p-10 task-detail">
                                        <div class="media m-t-0 m-b-20">
                                            <img class="d-flex mr-3 rounded-circle" src="{{ ($inProgressTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $inProgressTask->getUser->profile_picture)  }}" alt="Generic placeholder image" height="48">
                                            <div class="media-body">
                                                <h5 class="media-heading m-b-5 mt-0">{{ $inProgressTask->roles ?? $inProgressTask->getUser->name }}</h5>
                                                <span class="label label-danger">{{ $inProgressTask->status }}</span>
                                            </div>
                                        </div>
    
                                        <h4 class="font-600 m-b-20">{{ $inProgressTask->tasks }}</h4>
                                        <ul class="list-inline task-dates m-b-0 m-t-20">
                                            <li>
                                                <h5 class="font-600 m-b-5">Start Date</h5>
                                                <p>{{ $inProgressTask->created_at->format('d-M-Y') }}</p>
                                            </li>
    
                                            <li>
                                                <h5 class="font-600 m-b-5">Due Date</h5>
                                                <p> 
                                                    {{ \Carbon\Carbon::parse($inProgressTask->deadline)->format('d-M-Y') }}
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
    
                                        <div class="task-tags m-t-20">
                                            <h5 class="font-600">Description</h5>
                                            <h6>{{ $inProgressTask->task_description }}</h6>
                                        </div>
                                        <div class="attached-files m-t-30">
                                            <h5 class="font-600">Attached Files </h5>
                                            <div class="files-list">
                                                @if($inProgressTask->status == 'completed')
                                                    <div class="file-box">
                                                        <a href="{{ asset('uploads/tasks') }}/{{ $inProgressTask->getFiles->task_file }}">Download files</a>
                                                        <p class="font-13 m-b-5 text-muted"><small>File one</small></p>
                                                    </div>
                                                @else 
                                                    <p>No files attached yet.</p>
                                                @endif
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Go back</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                @php
                    $flag++;
                @endphp
                @empty 
                 <h5>No tasks are in progress at the moment.</h5>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0">Completed</h4>
            <p class="text-muted m-b-30 font-13">
               All completed Tasks.
            </p>
            @hasrole('Admin|Moderator')
            <ul class="sortable-list taskList list-unstyled" id="completed">
                @forelse ($completedTasks as $completedTask)        
                <li class="task-success" id="task">
                    <h5>{{ $completedTask->tasks }}</h5>
                    <p>Deadline : {{ \Carbon\Carbon::parse($completedTask->deadline)->format('d-M-Y') }}</p>
                    <div class="clearfix"></div>
                    <div class="m-t-20">
                        <p class="pull-right m-b-0 m-t-10">
                            <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#task-detail-modal{{ $flag }}">View</button>
                        </p>
                        <p class="m-b-0"><a href="" class="text-muted"><img src="{{ ($completedTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $completedTask->getUser->profile_picture)  }}" alt="task-user" class="thumb-sm rounded-circle m-r-10"> <span class="font-bold font-secondary">{{ $completedTask->roles ?? $completedTask->getUser->name }}</span></a> </p>
                    </div>
                </li>

                    <!-- Modal -->
                    <div id="task-detail-modal{{ $flag }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="modal-body">

                                <div class="p-10 task-detail">
                                    <div class="media m-t-0 m-b-20">
                                        <img class="d-flex mr-3 rounded-circle" src="{{ ($completedTask->roles) ? asset('uploads/users/default_profile_picture.jpg') : asset('uploads/users/' . $completedTask->getUser->profile_picture)  }}" alt="Generic placeholder image" height="48">
                                        <div class="media-body">
                                            <h5 class="media-heading m-b-5 mt-0">{{ $completedTask->roles ?? $completedTask->getUser->name }}</h5>
                                            <span class="label label-success">{{ $completedTask->status }}</span>
                                        </div>
                                    </div>

                                    <h4 class="font-600 m-b-20">{{ $completedTask->tasks }}</h4>
                                    <ul class="list-inline task-dates m-b-0 m-t-20">
                                        <li>
                                            <h5 class="font-600 m-b-5">Start Date</h5>
                                            <p>{{ $completedTask->created_at->format('d-M-Y') }}</p>
                                        </li>

                                        <li>
                                            <h5 class="font-600 m-b-5">Due Date</h5>
                                            <p> 
                                                {{ \Carbon\Carbon::parse($completedTask->deadline)->format('d-M-Y') }}
                                            </p>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>

                                    <div class="task-tags m-t-20">
                                        <h5 class="font-600">Description</h5>
                                        <p>{{ $completedTask->task_description }}</p>
                                    </div>

                                    <div class="task-tags m-t-20">
                                        <h5 class="font-600">Completed briefings</h5>
                                        <p>{{ $completedTask->getFiles->task_completion }}</p>
                                    </div>
                                    <div class="attached-files m-t-30">
                                        <h5 class="font-600">Attached Files </h5>
                                        <div class="files-list">
                                            @if($completedTask->status == 'completed')
                                                <div class="file-box">
                                                    <a href="{{ asset('uploads/tasks') }}/{{ $completedTask->getFiles->task_file }}" download>Download</a>
                                                    <p class="font-13 m-b-5 text-muted"><small>File one</small></p>
                                                </div>
                                            @else 
                                                <p>No files attached yet.</p>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Go Back</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @php
                    $flag++;
                @endphp
                @empty 
                 <h5>No completed tasks yet.</h5>
                @endforelse
                </li>
            </ul>
            @else 
            <h5>Only Admin and Moderator can view the completed tasks.</h5>
            @endhasrole
        </div>
    </div>

</div>
<!-- end row -->
@endsection