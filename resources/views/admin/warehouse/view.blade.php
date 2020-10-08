@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Available Warehouses</h1>
    </div>

    <div class="card shadow mb-4 p-2">
        <div class="card-body">
            @include('flash._notify')
            <div class="mb-4">
                <div class="">
                    <a class="btn btn-circle btn-success" href="{{ route('admin.add.warehouse') }}"><i class="fa fa-plus"></i></a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Created On</th>
                                <th>Region</th>
                                <th>longitude</th>
                                <th>latitude</th>
                                <th>Price</th>
                                <th>Crop Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warehouses as $warehouse)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($warehouse->created_at)->format('dS M Y') }}</td>
                                    <td>{{ $warehouse->region->name }}</td>
                                    <td>{{ $warehouse->longitude }}</td>
                                    <td>{{ $warehouse->latitude }}</td>
                                    <td>{{ $warehouse->price }}</td>
                                    <td>
                                        @foreach($warehouse->crops as $crop)
                                            {{ $crop->name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($warehouse->visible == 1)
                                            <a class="btn btn-danger" href="{{ route('admin.hide.warehouse',$warehouse->id) }}"><i class="fa fa-thumbs-down"></i> Hide Warehouse</a>
                                        @elseif($warehouse->visible == 0)
                                            <a class="btn btn-success" href="{{ route('admin.show.warehouse',$warehouse->id) }}"><i class="fa fa-thumbs-up"></i> Show Warehouse</a>
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
