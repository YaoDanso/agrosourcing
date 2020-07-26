@extends('admin.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Farmer Information System</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                @include('flash._notify')
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Manage Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Registered On</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>User Roles</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('dS M, Y') }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                {{ $role->name }},
                                            @endforeach
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
