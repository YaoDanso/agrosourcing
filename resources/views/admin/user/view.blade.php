@extends('admin.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Active Users</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                @include('flash._notify')
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage All Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Reg Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('dS M Y H:iA') }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if($user->status == 1)
                                            <p class="text-success font-weight-bold">Active</p>
                                        @elseif($user->status == 0)
                                            <p class="text-danger font-weight-bold">Suspended</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == 1)
                                            <a class="btn btn-danger" href="{{route('admin.suspend.user',$user->id)}}">
                                                <i class="fa fa-pause"></i>
                                                Suspend
                                            </a>
                                        @elseif($user->status == 0)
                                            <a class="btn btn-success" href="{{route('admin.unsuspend.user',$user->id)}}">
                                                <i class="fa fa-play-circle"></i>
                                                Unsuspend
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
