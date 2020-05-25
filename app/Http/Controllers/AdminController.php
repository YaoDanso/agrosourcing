<?php

namespace App\Http\Controllers;

use App\Crop;
use App\Farm;
use App\Product;
use App\Region;
use App\Warehouse;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home(){
        $chart_options = [
            'chart_title' => 'Users by Months',
            'report_type' => 'group_by_date',
            'model' => 'App\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $chart = new LaravelChart($chart_options);

        return view('admin.dashboard',compact('chart'));
    }

    public function addProduct(){
        $crops = Crop::all();
        $regions = Region::all();
        return view('admin.product.create',compact('crops','regions'));
    }
    public function viewProduct(){
        $products = Product::all();
        return view('admin.product.view',compact('products'));
    }

    public function addWarehouse(){
        $crops = Crop::all();
        $regions = Region::all();
        return view('admin.warehouse.create',compact('crops','regions'));
    }

    public function viewWarehouse(){
        $warehouses = Warehouse::all();
        return view('admin.warehouse.view',compact('warehouses'));
    }

    public function addFarm(){
        $crops = Crop::all();
        $regions = Region::all();
        return view('admin.farm.create',compact('crops','regions'));
    }

    public function viewFarm(){
        $farms = Farm::all();
        return view('admin.farm.view',compact('farms'));
    }
}
