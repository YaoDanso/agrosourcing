<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Product;
use App\Warehouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.dashboard');
    }

    public function orderList(){
        $farms = Farm::all();
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('user.order.order-list',compact('farms','warehouses','products'));
    }

    public function orderListDetail($id,$type){
        if ($type == 'farm'){
            $farm = Farm::where('id',$id)->first();
            return view('user.order.order-detail-farm',compact('farm'));
        }elseif ($type == 'warehouse'){
            $warehouse = Warehouse::where('id',$id)->first();
            return view('user.order.order-detail',compact('warehouse'));
        }
    }
}
