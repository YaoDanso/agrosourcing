@extends('user.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Your Selected Product</h1>
    </div>

    <div class="shadow mb-4 p-4">
        <h3 class="font-weight-light p-3">Product Details</h3>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <img class="card-img-top" src="{{ asset('img/farms/'.$farm->image) }}" alt="farm image" height="400px">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <h2 class="font-weight-bold mb-3">Project By {{ $farm->user->name }}</h2>
                @if($farm->user->profile->company !== null)
                    <h3 class="font-weight-light mb-3">{{ $farm->user->profile->company }}</h3>
                @endif
                <h4 class="font-weight-light mb-3">Crop Type: {{ $farm->crop->name }}</h4>
                <h4 class="font-weight-light mb-3">Price: GHS{{ $farm->price }} per Qty</h4>
                <h4 class="font-weight-light mb-3">Land Size: {{ $farm->size }}</h4>
                <div class="col-4 mt-4">
                    <div class="form-group">
                        <label for="">Product Quantity</label>
                        <input type="number" class="form-control" min="1" value="1">
                    </div>
                    <button class="btn btn-primary"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
@endsection
