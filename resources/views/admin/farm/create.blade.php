@extends('admin.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
@endsection
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
            <form action="{{ route('admin.store.farm') }}" method="post" enctype="multipart/form-data">
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
                <div class="form-group">
                    <label for="">Farm Size (In Acres)*</label>
                    <input type="number" class="form-control" min="0"
                           name="size" value="{{ old('size') }}">
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
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="region">Select Region*</label>
                            <select name="region" class="form-control" id="region">
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Select User*</label>
                            <select name="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="district">Select District</label>
                    <select name="district" id="district" class="form-control">
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" id="{{ $district->region_id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
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
                <div class="form-group mt-4 mb-4">
                    <p>Enable this if farm is organic</p>
                    <label class="switch">
                        <input type="checkbox" name="organic">
                        <span class="slider"></span>
                    </label>
                </div>


                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Add Farm Details <i class="fa fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var $select1 = $( '#region' ),
                $select2 = $( '#district' ),
                $options = $select2.find( 'option' );

            $select1.on( 'change', function() {
                $select2.html( $options.filter( '[id="' + this.value + '"]' ) );
            } ).trigger( 'change' );
        })
    </script>
@endsection
