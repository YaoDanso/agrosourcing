@extends('user.master')
@section('styles')
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.css" rel="stylesheet" />
    <style>
        #map { width: 100%; height: 70vh; }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Access Map</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('flash._notify')
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Number of Related Farms
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ count($farms) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-archive fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Size of Related Farms (Acres)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        @if(count($farms) > 0)
                                            <?php $total = 0; ?>
                                            @foreach($farms as $farm)
                                                <?php $total += $farm->size; ?>
                                            @endforeach
                                            {{ $total }}
                                        @else
                                            0
                                        @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-archive fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Number of Related Warehouses
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ count($warehouses) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-archive fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Number of Related Processing Companies
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ count($products) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-archive fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <div class="shadow-sm p-3">
                        <h4 class="font-weight-light mb-4">Farm Waste(s) Generated</h4>
                        @if(count($farms) > 0)
                            @foreach($farms as $farm)
                                @foreach($farm->crop->wastes as $waste)
                                    <p class="font-weight-bold">- {{ $waste->name }}</p>
                                @endforeach
                            @endforeach
                        @else
                            <p>No wastes found</p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="shadow-sm p-3">
                        <h4 class="font-weight-light mb-4">Warehouse Waste(s) Generated</h4>
                        @if(count($warehouses) > 0)
                            @foreach($warehouses as $warehouse)
                                @foreach($warehouse->crops as $crop)
                                    @foreach($crop->wastes as $waste)
                                        <p class="font-weight-bold">- {{ $waste->name }}</p>
                                    @endforeach
                                @endforeach
                            @endforeach
                        @else
                            <p>No wastes found</p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="shadow-sm p-3">
                        <h4 class="font-weight-light mb-4">Processing Waste(s) Generated</h4>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <p>- {{ $product->wastes }}</p>
                            @endforeach
                        @else
                            <p>No wastes found</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4 offset-4 mt-5">
                <div class="form-group">
                    <a class="btn btn-primary btn-block" href="#" data-toggle="modal" data-target="#mapModal">
                        View Map
                        <i class="fa fa-map-marker-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Map View</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYW5keTA1NCIsImEiOiJjazVmOHlvMzYwNXJ4M2tvNmV4dDlkYmJqIn0.lSHrnADHWaRsb08uqECHRg';
        let map = new mapboxgl.Map({
            container: 'map', // container id
            style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
            center: [12.550343, 55.665957], // starting position [lng, lat]
            zoom: 9 // starting zoom
        });
        let marker = new mapboxgl.Marker()
            .setLngLat([12.550343, 55.665957])
            .addTo(map);
    </script>
@endsection
