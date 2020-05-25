@extends('admin.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>{{ $chart->options['chart_title'] }}</h1>
            {!! $chart->renderHtml() !!}
        </div>
    </div>
@endsection
@section('scripts')
    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}
@endsection
