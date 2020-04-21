@extends('user.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Products Available</h1>
    </div>

    <div class="shadow mb-4 p-4">
        <h3 class="font-weight-light p-3">Select a product to order</h3>
        @if(count($farms) > 0 or count($warehouses) > 0 or count($products) > 0)
            <div class="row">
                @foreach($farms as $farm)
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-dot-circle text-success"></i> Farm</h5>
                                <p class="card-text">Crop Type: {{ $farm->crop->name }}</p>
                                <p class="card-text">Farm Size: {{ $farm->size }}</p>
                                <p class="card-text">Price: GHS{{ $farm->price }}</p>
                                <a href="#" class="btn btn-circle btn-primary"><i class="fa fa-cart-plus"></i></a>
                                <p class="card-text"><small class="text-muted">Last updated {{\Carbon\Carbon::parse($farm->updated_at)->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($warehouses as $warehouse)
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-dot-circle text-warning"></i> Warehouse</h5>
                                <p class="card-text">Region: {{ $warehouse->region }} Region</p>
                                <p class="card-text">Price: GHS{{ $warehouse->price }}</p>
                                <p class="card-text">Crops:
                                    @foreach( $warehouse->crops as $crop)
                                        {{ $crop->name }},
                                    @endforeach
                                </p>
                                <a href="#" class="btn btn-circle btn-primary"><i class="fa fa-cart-plus"></i></a>
                                <p class="card-text"><small class="text-muted">Last updated {{\Carbon\Carbon::parse($warehouse->updated_at)->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($products as $product)
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="font-weight-light">No items available to order</h3>
        @endif
    </div>
{{--    <ul class="pagination justify-content-center">
        {{ $posts->render() }}
    </ul>--}}
@endsection
