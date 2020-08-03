<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Farm;
use App\Notifications\AdminNotification;
use App\Notifications\OrderNotification;
use App\Notifications\OrderNotificationAdmin;
use App\Notifications\UserNotification;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Shipping;
use App\Warehouse;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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
        $farms = Farm::all();
        $products = Product::all();
        $warehouses = Warehouse::all();
        $orders = Order::where('user_id',\auth()->user()->id)->get();

        return view('user.dashboard',compact('farms','products','warehouses','orders'));
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
            }elseif ($category == 'product'){
                $data = Product::where('materials','LIKE','%'.\request('item').'%')->get();
                $results[]["product"] = $data;
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
        }elseif ($type == 'product'){
            $product = Product::where('id',$id)->first();
            return view('user.order.order-detail-product',compact('product'));
        }
    }

    public function addToCart($id,$type){
        if ($type == 'farm'){
            $qty = \request('qty');
            $farm = Farm::where('id',$id)->first();
            \Cart::add(array(
                'id' => Str::random(6).$farm->id,
                'name' => $farm->user_id == null ? 'Agrosourcing Support' : $farm->user->name . " farm",
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
            \Cart::add(array(
                'id' => Str::random(6).$warehouse->id,
                'name' => $warehouse->user_id == null ? 'Agrosourcing Support' : $warehouse->user->name . " warehouse",
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
        }elseif ($type == 'product'){
            $qty = \request('qty');
            $product = Product::where('id',$id)->first();
            \Cart::add(array(
                'id' => Str::random(6).$product->id,
                'name' => $product->name,
                'price' => (double)$product->price,
                'quantity' => $qty,
                'attributes' => array(
                    'crop' => $product->materials,
                    'image' => $product->image,
                    'type' => 'processing company'
                )
            ));
            return response(array(
                'success' => true,
                'message' => "item added."
            ),201,[]);
        }
    }

    public function removeCart($rowId){
        \Cart::remove($rowId);
        return redirect()->back()->with('success','Item is removed successfully');
    }

    public function billing(){
        return view('user.order.billing');
    }

    public function checkout(Request $request){
        //dd($request);
        $data = array();
        $o_data = array();
        $p_data = array();

        $data["name"] = $request->first_name . " " .$request->last_name;
        $data["company"] = $request->company_name;
        $data["address"] = $request->address;
        $data["city"] = $request->city;
        $data["ghana_post"] = $request->ghana_post;
        $data["phone"] = $request->phone;
        $data["user_id"] = auth()->user()->id;
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        $payment = $request->options;
        $order_code = substr(sha1(time()),0,6);
        $shipping_id = "";
        $order_id = "";

        //checking to see if the Shipping table has a user already the update otherwise insert new entry
        $check = Shipping::where('user_id',auth()->user()->id)->first();
        if ($check){
            Shipping::where('user_id',Auth::user()->id)
                ->update($data);
            $shipping_id = $check->id;
        }else{
            $shipping_id = DB::table('shippings')
                ->insertGetId($data);
        }

        //insert items into orders table and update others later
        $o_data["user_id"] = Auth::user()->id;
        $o_data["shipping_id"] = $shipping_id;
        $o_data["total"] = \Cart::getTotal();
        $o_data["status"] = 1;
        $o_data["code"] = $order_code;
        $o_data["created_at"] = Carbon::now();
        $o_data["updated_at"] = Carbon::now();

        $order_id = DB::table('orders')
            ->insertGetId($o_data);

        //insert into payment with the order id
        $p_data["method"] = $payment;
        $p_data["status"] = 1;
        $p_data["order_id"] = $order_id;
        $p_data["created_at"] = Carbon::now();
        $p_data["updated_at"] = Carbon::now();
        $payment_id = DB::table('payments')->insertGetId($p_data);
        Order::where('code',$order_code)->update(['payment_id'=> $payment_id]);

        $carts = \Cart::getContent();
        foreach ($carts as $cart){
            OrderDetail::create([
                'name' => $cart->name,
                'image' => $cart->attributes->image,
                'type' => $cart->attributes->type,
                'price' => $cart->price,
                'qty' => $cart->quantity,
                'order_id' => $order_id
            ]);
        }
        \Cart::clear();
        $title = "Order";
        $message = "You have successfully place an order with code $order_code";
        \auth()->user()->notify(new OrderNotification($order_code));
        Notification::send(\auth()->user(),new UserNotification($title,$message));
        $admins = Admin::where('level',1)->get();
        $messageAdmin = "You have received an order!";
        foreach ($admins as $admin){
            Notification::send($admin, new AdminNotification($messageAdmin));
            $admin->notify(new OrderNotificationAdmin($order_code));
        }
        return redirect()->route('user.welcome')
            ->with('success','Your order was successfully placed with code: '.$order_code);
    }

    public function accessMap(){

        $crop = \request('crop');
        $region = \request('region');

        $farms = Farm::join('regions','regions.id','farms.region_id')
            ->join('crops','crops.id','=','farms.crop_id')
            ->where('crops.name','LIKE', '%'.$crop.'%')
            ->where('farms.region_id',$region)
            ->select('farms.*')
            ->get();

        $warehouses = Warehouse::whereHas('crops', function ($query){
            $query->where('name','LIKE','%'.\request('crop').'%');
        })->join('regions','regions.id','warehouses.region_id')
            ->where('warehouses.region_id',$region)
            ->select('warehouses.*')
            ->get();

        $products = Product::join('regions','regions.id','products.region_id')
            ->where('products.materials','LIKE', '%'.$crop.'%')
            ->where('products.region_id',$region)
            ->select('products.*')
            ->get();

        return view('user.map.map',compact('farms','warehouses','products'));
    }

    public function markAsRead(){

        foreach(auth()->user()->unReadNotifications as $notification){
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    /*public function notifications(){
        return view('user.notifications');
    }*/
}
