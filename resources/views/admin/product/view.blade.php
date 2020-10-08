@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Products</h1>
    </div>

    <div class="card shadow mb-4 p-2">
        <div class="card-body">
            @include('flash._notify')
            <div class=" mb-4">
                <div class="">
                    <a class="btn btn-circle btn-success" href="{{ route('admin.add.product') }}"><i class="fa fa-plus"></i></a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Created On</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>longitude</th>
                                <th>latitude</th>
                                <th>Region</th>
                                <th>Price</th>
                                <th>Materials</th>
                                <th>Business</th>
                                <th>Wastes</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('dS M Y') }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->longitude }}</td>
                                    <td>{{ $product->latitude }}</td>
                                    <td>{{ $product->region->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->materials }}</td>
                                    <td>{{ $product->business }}</td>
                                    <td>{{ $product->wastes }}</td>
                                    <td>
                                        @if($product->visible == 1)
                                            <a class="btn btn-danger" href="{{ route('admin.hide.product',$product->id) }}"><i class="fa fa-thumbs-down"></i> Hide Product</a>
                                        @elseif($product->visible == 0)
                                            <a class="btn btn-success" href="{{ route('admin.show.product',$product->id) }}"><i class="fa fa-thumbs-up"></i> Show Product</a>
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
