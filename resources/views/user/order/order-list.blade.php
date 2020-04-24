@extends('user.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Products Available</h1>
    </div>
    <div class="shadow mb-4 p-4">
        <div class="row">
            <div class="col-4 offset-8">
                <form action="{{ route('user.view.orderList') }}" class="search-wrap" method="GET">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" style="width:35%;" placeholder="Search Item" name="item">
                        <select class="custom-select" name="category">
                            <option value="farm">Farm</option>
                            <option value="warehouse">Warehouse</option>
                            <option value="product">Products</option>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h3 class="font-weight-light p-3">Select a product to order</h3>
        @if(count($farms) > 0 or count($warehouses) > 0 or count($products) > 0)
            <div class="row">
                @foreach($farms as $farm)
                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 mb-3">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="{{ asset('img/farms/'.$farm->image) }}" alt="warehouse image" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-dot-circle text-success"></i> Farm</h5>
                                <h6 class="card-text">{{ $farm->user->name }}
                                    @if($farm->user->profile->company !== null) - {{ $farm->user->profile->company }}@endif</h6>
                                <p class="card-text">Crop Type: {{ $farm->crop->name }}</p>
                                <p class="card-text">Farm Size: {{ $farm->size }}</p>
                                <p class="card-text">Price: GHS{{ $farm->price }} per unit</p>
                                <a href="{{ route('user.view.orderList.detail',['id'=>$farm->id,'type'=>'farm']) }}" class="btn btn-circle btn-primary"><i class="fa fa-cart-plus"></i></a>
                                <p class="card-text"><small class="text-muted">Last updated {{\Carbon\Carbon::parse($farm->updated_at)->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($warehouses as $warehouse)
                    <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="{{ asset('img/warehouses/'.$warehouse->image) }}" alt="warehouse image" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-dot-circle text-warning"></i> Warehouse</h5>
                                <h6 class="card-text">{{$warehouse->user->name}}
                                @if($warehouse->user->profile->company !== null) - {{ $warehouse->user->profile->company }}@endif</h6>
                                <p class="card-text">Region: {{ $warehouse->region }} Region</p>
                                <p class="card-text">Crop Type(s): {{$warehouse->crops[0]->name}} </p>
                                <p class="card-text">Price: GHS{{ $warehouse->price }} per unit </p>
                                <a href="{{ route('user.view.orderList.detail',['id'=>$warehouse->id,'type'=>'warehouse']) }}" class="btn btn-circle btn-primary"><i class="fa fa-cart-plus"></i></a>
                                <p class="card-text"><small class="text-muted">Last updated {{\Carbon\Carbon::parse($warehouse->updated_at)->diffForHumans()}}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--@foreach($products as $product)
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
        @else
            <h3 class="font-weight-light">No items available to order</h3>
        @endif
    </div>
@endsection
