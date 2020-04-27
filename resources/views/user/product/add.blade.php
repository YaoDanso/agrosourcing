@extends('user.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product</h1>
    </div>

    <div class="card shadow mb-4 p-3">
        <div class="card-body">
            @include('flash._notify')
            <form action="{{ route('user.store.product') }}" method="post" enctype="multipart/form-data">
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
                            <label for="name">Price Per Quantity</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Raw materials used (Separate with comma if you have more than one)</label>
                            <textarea class="form-control" name="materials" required rows="3"></textarea>
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
                                <option value="Eastern">Eastern Region</option>
                                <option value="Central">Central Region</option>
                                <option value="Greater Accra">Greater Accra Region</option>
                                <option value="Oti ">Oti Region</option>
                                <option value="Bono East">Bono East Region</option>
                                <option value="Bono">Bono Region</option>
                                <option value="Savannah">Savannah Region</option>
                                <option value="Ahafo">Ahafo Region</option>
                                <option value="Western North">Western North Region</option>
                                <option value="Western North">Western North Region</option>
                                <option value="Western">Western Region</option>
                                <option value="Volta">Volta Region</option>
                                <option value="Ashanti">Ashanti Region</option>
                                <option value="Northern">Northern Region</option>
                                <option value="Upper East">Upper East Region</option>
                                <option value="Upper West">Upper West Region</option>
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
                <div class="form-group mt-4">
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-plus"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
