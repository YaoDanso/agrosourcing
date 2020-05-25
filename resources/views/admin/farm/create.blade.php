@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Farm</h1>
    </div>



    <div class="card shadow mb-4 p-5">
        <h5 class="font-weight-lighter">PROVIDE FARM DETAILS</h5>
        <p class="font-weight-normal">Choose a crop type, the wastes will be generated for you.</p>
        @include('flash._notify')
        <div class="card-body">
            <form action="{{ route('user.store.farm') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Longitude*</label>
                            <input type="text" class="form-control" name="longitude" value="{{ old('longitude') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Latitude*</label>
                            <input type="text" class="form-control" name="latitude" value="{{ old('latitude') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Farm Size (In Acres)*</label>
                            <input type="number" class="form-control" min="0"
                                   name="size" value="{{ old('size') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Price per Quantity*</label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Select Crop*</label>
                            <select name="crop" class="form-control">
                                @foreach($crops as $crop)
                                    <option value="{{$crop->id}}">{{$crop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Farm Image*</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Select Region*</label>
                    <select name="region" class="form-control">
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add Farm Details <i class="fa fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection