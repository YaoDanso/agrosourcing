<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Product;
use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cart;

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

    public function cart()
    {
        return view('user.order.cart');
    }

    public function orderList(){
        if (\request('category') && \request('item')){
            $category = \request('category');
            $results = [];
            $item = \request('item');
            if ($category == 'farm'){
                $data = Farm::join('crops','crops.id','=','farms.crop_id')
                            ->where('crops.name', 'LIKE', '%'.$item.'%')->get();
                $results[]["farm"] = $data;
            }elseif ($category == 'warehouse'){
                $data = Warehouse::whereHas('crops', function ($query){
                    $query->where('name','LIKE','%'.\request('item').'%');
                })->get();
                $results[]["warehouse"] = $data;
            }
            return view('user.order.search',compact('results'));
        }else{
            $farms = Farm::all();
            $warehouses = Warehouse::all();
            $products = Product::all();
            return view('user.order.order-list',compact('farms','warehouses','products'));
        }
    }

    public function orderListDetail($id,$type){
        if ($type == 'farm'){
            $farm = Farm::where('id',$id)->first();
            return view('user.order.order-detail-farm',compact('farm'));
        }elseif ($type == 'warehouse'){
            $warehouse = Warehouse::where('id',$id)->first();
            return view('user.order.order-detail-warehouse',compact('warehouse'));
        }
    }

    public function addToCart($id,$type){
        if ($type == 'farm'){
            $qty = \request('qty');
            $farm = Farm::where('id',$id)->first();
            $userId = auth()->user()->uuid;
            //echo $qty . " - " . $farm . " - " . $rowId . " - " . $userId;
            Cart::add(array(
                'id' => Str::random(6).$farm->id,
                'name' => $farm->user->name . " farm",
                'price' => (double)$farm->price,
                'quantity' => $qty,
                'attributes' => array(
                    'crop' => $farm->crop->name,
                    'image' => $farm->image,
                    'type' => 'farm'
                )
            ));
            return response(array(
                'success' => true,
                'message' => "item added."
            ),201,[]);
        }elseif ($type == 'warehouse'){
            $qty = \request('qty');
            $warehouse = Warehouse::where('id',$id)->first();
            //echo $qty . " - " . $farm . " - " . $rowId . " - " . $userId;
            Cart::add(array(
                'id' => Str::random(6).$warehouse->id,
                'name' => $warehouse->user->name . " warehouse",
                'price' => (double)$warehouse->price,
                'quantity' => $qty,
                'attributes' => array(
                    'crop' => $warehouse->crops[0]->name,
                    'image' => $warehouse->image,
                    'type' => 'warehouse'
                )
            ));
            return response(array(
                'success' => true,
                'message' => "item added."
            ),201,[]);
        }
    }

    public function removeCart($rowId){
        Cart::remove($rowId);
        return redirect()->back()->with('success','Item is removed successfully');
    }
}
