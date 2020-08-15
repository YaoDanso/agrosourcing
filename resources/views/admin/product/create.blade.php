@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product</h1>
    </div>

    <div class="card shadow mb-4 p-3">
        <div class="card-body">
            <h5 class="font-weight-lighter">PROVIDE PRODUCT DETAILS</h5>
            <p class="font-weight-normal">All fields are required.</p>
            @include('flash._notify')
            <form action="{{ route('admin.store.product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name of Product</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Description of Product</label>
                            <textarea class="form-control" name="description" required rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Raw materials used (Separate with comma if you have more than one)</label>
                            <textarea class="form-control" name="materials" required rows="3"></textarea>
                        </div>

                            <div class="form-group">
                                <label for="">Select User*</label>
                                <select name="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name of Business</label>
                            <input type="text" class="form-control" name="business" required>
                        </div>
                        <div class="form-group">
                            <label for="">Select Region</label>
                            <select name="region" class="form-control">
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Longitude</label>
                                    <input type="text" class="form-control" name="longitude" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Generated Wastes (Separate with comma if you have more than one)</label>
                            <input type="text" name="wastes" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Choose a picture for Product</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="">Currency*</label>
                        <select name="currency"  class="form-control">
                            <option value="GHS">GHS</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Price*</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="">Quantity*</label>
                        <select name="quantity"  class="form-control">
                            <option value="Ton">Ton</option>
                            <option value="Kilogram">Kilogram</option>
                            <option value="Cubic feet">Cubic feet</option>
                            <option value="Cubic Meters">Cubic Meters</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-plus"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
