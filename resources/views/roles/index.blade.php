@extends('layouts.dashboard')


@section('roles-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Role Management</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Roles & Permissions</li>
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

     @hasrole('Admin')
     <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Role name</th>
                        <th>Permissions</th>
                    </tr>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><strong>{{ $role->name }}</strong></td>
                            <td>
                                <ol>
                                @foreach ($role->getPermissionNames() as $permission)
                                        <li>{{ strtoupper($permission) }}</li>
                                @endforeach
                                </ol>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Roles</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" class="form-group" method="post">
                        @csrf 
                        <div class="p-3">
                            <input type="text" class="form-control" name="role_name" placeholder="Enter role name">
                        </div>
                        <div class="head p-3">
                            <h5>Permissions</h5>
                        </div>
                        <div class="p-3">
                            @foreach ($permissions as $permission)
                            <h6 class="d-inline-block">{{ strtoupper($permission->name) }}</h6>
                                <label class="switch mr-3">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                    <span class="slider round"></span>
                                  </label>
                            @endforeach
                        </div>
                        <div class="p-3">
                            <button style="cursor: pointer;" type="submit" class="btn btn-success btn-rounded">Add Roles</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="head p-5">
        <h2>Users & Roles</h2>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>User name</th>
                        <th>Roles</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>
                                @if($user->hasAnyRole($roles))
                                @foreach ($user->getRoleNames() as $userRole)
                                  {{ $userRole }}
                                @endforeach
                                @else 
                                  No Roles
                                @endif
                            </td>
                            <td>
                                @if($user->hasAnyPermission($permissions))
                                <ol>
                                    @foreach ($user->getAllPermissions() as $permission)
    
                                        <li>{{ strtoupper($permission->name) }}</li>
    
                                    @endforeach
                                </ol>
                                @else
                                   No Permissions
                                @endif 
                            </td>
                            <td>
                                @if($user->hasAnyRole('User'))
                                <button class="btn btn-success btn-sm">No actions required</button>
                                @else 
                                <a href="{{ route('roles.revoke', $user->id) }}" class="btn btn-danger btn-sm">Demote to user</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </table>
                {{ $users->links() }}
            </div>
           
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Assign Roles</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.assign') }}" class="form-group" method="post">
                        @csrf 
                        <div class="head p-3">
                            <h5>User List</h5>
                        </div>
                        <div class="p-3">
                            <select class="form-control" name="user_name" id="">
                                <option value="">-Select User-</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="head p-3">
                            <h5>Roles</h5>
                        </div>
                        <div class="p-3">
                            <select class="form-control" name="role_name" id="">
                                <option value="">-Assign role-</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                              </select>
                        </div>
                        <div class="p-3">
                            <button style="cursor: pointer;" type="submit" class="btn btn-success btn-rounded">Add Roles</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @else 
       <h6>You're not authorized to manage the roles and permission. Please Contact the authorities</h6> 
    @endhasrole
@endsection
