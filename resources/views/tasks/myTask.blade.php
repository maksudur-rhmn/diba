@extends('layouts.dashboard')
@section('title')
    ANA | Task Management
@endsection

@section('tasks-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">My Task</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">My Task</li>
</ol>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
 <div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card-box">
            @hasrole('Admin|Moderator')
            <a href="{{ route('tasks.index') }}" class="pull-right btn btn-secondary btn-sm waves-effect waves-light">Add New</a>
            @endhasrole
            <h4 class="text-dark header-title m-t-0">Assigned to your role</h4>
            <p class="text-muted m-b-30 font-13">
                These are the list of the task assigned to your roles.
            </p>

            <ul class="sortable-list taskList list-unstyled" id="upcoming">
                @php
                    $flag = 1;
                @endphp
                @forelse ($taskRoles as $upcomingTask)
                <li class="task-warning" id="task">
                    <h5>{{ $upcomingTask->tasks }}</h5>
                    <p>Deadline : {{ \Carbon\Carbon::parse($upcomingTask->deadline)->format('d-M-Y') }}</p>
                    <div class="clearfix"></div>
                    <div class="m-t-20">
                        <p class="pull-right m-b-0 m-t-10">
                            <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#task-detail-modal{{ $flag }}">View</button>
                            @if($upcomingTask->roles == userRole() || $upcomingTask->user_id == Auth::id())
                              <a href="{{ route('tasks.started', $upcomingTask->id) }}" class="btn btn-warning btn-xs waves-effect waves-light">{{ ($upcomingTask->status == 'in progress') ? 'In progress' : 'Start Task' }}</a>
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
        {{ $taskRoles->links() }}
    </div>
 </div>
 <div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card-box">
            @hasrole('Admin|Moderator')
            <a href="{{ route('tasks.index') }}" class="pull-right btn btn-secondary btn-sm waves-effect waves-light">Add New</a>
            @endhasrole
            <h4 class="text-dark header-title m-t-0">Assigned to you</h4>
            <p class="text-muted m-b-30 font-13">
                These are the list of the task assigned to you only.
            </p>

            <ul class="sortable-list taskList list-unstyled" id="upcoming">
                @forelse ($taskUser as $upcomingTask)
                <li class="task-warning" id="task">
                    <h5>{{ $upcomingTask->tasks }}</h5>
                    <p>Deadline : {{ \Carbon\Carbon::parse($upcomingTask->deadline)->format('d-M-Y') }}</p>
                    <div class="clearfix"></div>
                    <div class="m-t-20">
                        <p class="pull-right m-b-0 m-t-10">
                            <button type="button" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#task-detail-modal{{ $flag }}">View</button>
                            @if($upcomingTask->roles == userRole() || $upcomingTask->user_id == Auth::id())
                              <a href="{{ route('tasks.started', $upcomingTask->id) }}" class="btn btn-warning btn-xs waves-effect waves-light">{{ ($upcomingTask->status == 'in progress') ? 'In progress' : 'Start Task' }}k</a>
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
        {{ $taskUser->links() }}
    </div>
 </div>
@endsection