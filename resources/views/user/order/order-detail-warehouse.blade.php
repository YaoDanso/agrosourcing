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
                <img class="card-img-top" src="{{ asset('img/warehouses/'.$warehouse->image) }}" alt="warehouse image" height="400px">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <h2 class="font-weight-bold mb-3">Project By
                    @if($warehouse->user_id != null)
                        {{ $warehouse->user->name }}
                        @if($warehouse->user->profile->company !== null) - {{ $warehouse->user->profile->company }}@endif
                    @else
                        Agrosourcing Support
                    @endif
                </h2>
                @if($warehouse->user_id != null)
                    @if($warehouse->user->profile->company !== null)
                        <h3 class="font-weight-light mb-3">{{ $warehouse->user->profile->company }}</h3>
                    @endif
                @endif
                <h4 class="font-weight-light mb-3">Crop Type(s):
                    @foreach($warehouse->crops as $crop)
                        {{ $crop->name }},
                    @endforeach
                </h4>
                <h4 class="font-weight-light mb-3">Price: {{$warehouse->currency}}{{ $warehouse->price }} per {{$warehouse->quantity}}</h4>
                <h4 class="font-weight-light mb-3">Location: {{ $warehouse->region->name }}</h4>
                <div class="col-4 mt-4">
                    <div class="form-group">
                        <label for="">Product Quantity</label>
                        <input type="number" class="form-control" min="1" value="1" id="cartQty">
                    </div>
                    <button class="btn btn-primary" id="cartBtn"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Item Added</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="font-weight-light">Your Item is Successfully Added To Cart</h3>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.view.orderList') }}" class="btn btn-secondary">Continue Shopping</a>
                    <a href="{{ route('user.view.cart') }}" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#cartBtn').click(function () {
                var qty = $('#cartQty').val();
                if (qty < 1){
                    alert("Quantity has to be more than one")
                }else{
                    $.ajax({
                        method: "GET",
                        url: "{{ route('user.add.cart',['id'=>$warehouse->id,'type'=>'warehouse']) }}?qty="+qty,
                        success: function (data) {
                            if (data.success){
                                $('#successModal').modal('show');
                            }
                        },
                        error: function (err) {
                            console.log(err)
                        }
                    })
                }
            })
        })
    </script>
@endsection
