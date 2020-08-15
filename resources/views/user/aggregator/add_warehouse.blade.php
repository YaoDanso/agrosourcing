@extends('user.master')
@section('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Warehouse</h1>
    </div>

    <div class="card shadow mb-4 p-3">
        <div class="card-body">
            @include('flash._notify')
            <form action="{{ route('user.store.warehouse') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Longitude">Longitude*</label>
                            <input type="text" name="longitude" class="form-control" required value="{{ old('longitude') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Latitude">Latitude*</label>
                            <input type="text" name="latitude" class="form-control" required value="{{ old('latitude') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Select Region*</label>
                            <select name="region" class="form-control">
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Select Crop Types*</label>
                            <select class="form-control select2-multi"
                                    name="crops[]" multiple="multiple" id="crops" required>
                                @foreach($crops as $crop)
                                    <option value="{{$crop->id}}">{{$crop->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Warehouse Image*</label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
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
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-plus"></i> Add Warehouse
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2-multi').select2();
        })
    </script>
@endsection
