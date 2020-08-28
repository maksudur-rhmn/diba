@extends('layouts.dashboard')

@section('title')
    ANA | Users
@endsection

@section('user-active')
    active
@endsection

@section('breadcrumb')
<h4 class="page-title float-left">Manage all users</h4>

<ol class="breadcrumb float-right">
   <li class="breadcrumb-item"><a href="{{ route('home') }}">ANA</a></li>
   {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
   <li class="breadcrumb-item active">Users</li>
</ol>
@endsection

@section('inline-css')
 
<link href="{{ asset('dashboard_assets/assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('dashboard_assets/assets/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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

<div class="row">
    <div class="col-12">
        @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
       @endif
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Manage users</b></h4>

            <table id="datatable" class="table table-bordered">
                <thead>
                <tr style="color: #000;">
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>User since</th>
                    <th>Action</th>
                    <th>Create Admin</th>
                </tr>
                </thead>


                <tbody>
                  @forelse ($users as $user)
                   <tr style="color: #222;">
                       <td>{{ $loop->index + 1 }}</td>
                       <td>{{ $user->name }}</td>
                       <td>{{ $user->email }}</td>
                       <td>
                           @if(Cache::has('user-is-online-' . $user->id))
                           <span class="text-success">Online</span>
                           @else
                           <span class="text-secondary">Offline</span>
                           @endif
                        </td>
                        <td>
                            @foreach ( $user->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach
                        </td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}</td>
                        <td>
                            @can('view')
                             <a href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye mr-3" style="color:#183153;font-size: 22px;"></i></a>
                            @endcan
                            @can('edit')
                             <a href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit (alias) mr-3" style="color:#FCB800;font-size: 22px;"></i></a>
                            @endcan
                            @can('delete')
                                <a href="{{ route('users.delete', $user->id) }}"><i class="fa fa-trash-o" style="color:red;font-size: 20px;"></i></a>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('create.admin', $user->id) }}" class="btn btn-warning">Make Admin</a>
                        </td>
                   </tr>
                  @empty
                   <tr>
                       <td>No user data available.</td>
                   </tr>
                  @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->

@endsection

@section('footer-script')
 <!-- Required datatable js -->
 
 <script src="{{ asset('dashboard_assets/assets/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('dashboard_assets/assets/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );

</script>
@endsection