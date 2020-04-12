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
            <form action="{{ route('user.store.warehouse') }}" method="post">
                @csrf
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
                            <label for="Longitude">Longitude</label>
                            <input type="text" name="longitude" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Latitude">Latitude</label>
                            <input type="text" name="latitude" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Select Crop Types</label>
                    <select class="form-control select2-multi"
                            name="crops[]" multiple="multiple" id="crops" required>
                        @foreach($crops as $crop)
                            <option value="{{$crop->id}}">{{$crop->name}}</option>
                        @endforeach
                    </select>
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
