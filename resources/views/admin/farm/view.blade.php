@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Available Farms</h1>
    </div>

    <div class="card shadow mb-4 p-2">
        <div class="card-body">
            @include('flash._notify')
            <div class="mb-4">
                <div class="">
                    <a class="btn btn-circle btn-success" href="{{ route('admin.add.farm') }}"><i class="fa fa-plus"></i></a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Created On</th>
                                <th>longitude</th>
                                <th>latitude</th>
                                <th>size</th>
                                <th>region</th>
                                <th>Crop</th>
                                <th>Wastes</th>
                                <th>Organic</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($farms as $farm)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($farm->created_at)->format('dS M Y') }}</td>
                                    <td>{{ $farm->longitude }}</td>
                                    <td>{{ $farm->latitude }}</td>
                                    <td>{{ $farm->size }}</td>
                                    <td>{{ $farm->region->name }}</td>
                                    <td>{{ $farm->crop->name }}</td>
                                    <td>
                                        @foreach($farm->crop->wastes as $waste)
                                            <p>{{$waste->name}}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($farm->organic == 1)
                                            <p class="text-success">Yes</p>
                                        @else
                                            <p class="text-danger">No</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($farm->visible == 1)
                                            <a class="btn btn-danger" href="{{ route('admin.hide.farm',$farm->id) }}"><i class="fa fa-thumbs-down"></i> Hide Farm</a>
                                        @elseif($farm->visible == 0)
                                            <a class="btn btn-success" href="{{ route('admin.show.farm',$farm->id) }}"><i class="fa fa-thumbs-up"></i> Show Farm</a>
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
