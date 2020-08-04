<?php

namespace App\Http\Controllers;

use App\Crop;
use App\Farm;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Region;
use App\Role;
use App\Trucker;
use App\User;
use App\Warehouse;
use App\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;
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

        $farms = Farm::all();
        $products = Product::all();
        $warehouses = Warehouse::all();
        $orders = Order::all();
        return view('admin.dashboard',compact('chart','farms','products','warehouses','orders'));
    }

    public function addProduct(){
        $crops = Crop::all();
        $regions = Region::all();
        $users = User::all();
        return view('admin.product.create',compact('crops','regions','users'));
    }
    public function viewProduct(){
        $products = Product::all();
        return view('admin.product.view',compact('products'));
    }

    public function addWarehouse(){
        $crops = Crop::all();
        $regions = Region::all();
        $users = User::all();
        return view('admin.warehouse.create',compact('crops','regions','users'));
    }

    public function viewWarehouse(){
        $warehouses = Warehouse::all();
        return view('admin.warehouse.view',compact('warehouses'));
    }

    public function addFarm(){
        $crops = Crop::all();
        $regions = Region::all();
        $users = User::all();
        return view('admin.farm.create',compact('crops','regions','users'));
    }

    public function viewFarm(){
        $farms = Farm::all();
        return view('admin.farm.view',compact('farms'));
    }

    public function storeFarm(Request $request)
    {
        $this->validate($request,[
            'size' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $farm = new Farm();
        $farm->longitude = $request->longitude;
        $farm->latitude = $request->latitude;
        $farm->size = $request->size;
        $farm->crop_id = $request->crop;
        $farm->price = $request->price;
        $farm->region_id = $request->region;
        $farm->user_id = $request->user_id;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $new_name = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('img/farms/'.$new_name);
            Image::make($image)->resize(450, 320)->save($location,90);
            $farm->image = $new_name;
        }
        $farm->save();

        //sending notification
        $message = "You added a new farm project";
        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));
        return redirect()->route('admin.view.farm')
            ->with('success','Farm added successfully!');
    }

    public function showFarm(Farm $farm){
        $farm->visible = 1;
        $farm->save();
        return redirect()->route('admin.view.farm')
            ->with('success','Farm successfully updated!');
    }

    public function hideFarm(Farm $farm){
        $farm->visible = 0;
        $farm->save();
        return redirect()->route('admin.view.farm')
            ->with('success','Farm successfully updated!');
    }

    public function storeWarehouse(Request $request)
    {
        $this->validate($request,[
            'region' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $warehouse = new Warehouse();
        $warehouse->region_id = $request->region;
        $warehouse->longitude = $request->longitude;
        $warehouse->latitude = $request->latitude;
        $warehouse->price = $request->price;
        $warehouse->user_id = $request->user_id;

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $new_name = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('img/warehouses/'.$new_name);
            Image::make($image)->resize(450, 320)->save($location,90);
            $warehouse->image = $new_name;
        }

        $warehouse->save();
        $warehouse->crops()->sync($request->crops, false);
        //sending notification
        $message = "You added a new warehouse project";
        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));

        return redirect()->route('admin.view.warehouse')
            ->with('success','Warehouse successfully added!');
    }

    public function storeProduct(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $new_name = time() . "." . $image->getClientOriginalExtension();
            $location = public_path('img/products/'.$new_name);
            Image::make($image)->resize(450, 320)->save($location,90);

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'materials' => $request->materials,
                'business' => $request->business,
                'region_id' => $request->region,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'wastes' => $request->wastes,
                'image' => $new_name,
                'user_id' => $request->user_id
            ]);
            //sending notification
            $message = "You added a new product!";
            //database Notification
            Notification::send(auth()->user(),new AdminNotification($message));
        }

        return redirect()->route('admin.view.product')
            ->with('success','Product was created successfully!');
    }

    public function viewUsers(){
        $users = User::all();
        return view('admin.user.view',compact('users'));
    }

    public function suspendUser($id){
        User::where('id',$id)
            ->update(['status' => 0]);
        //sending notification
        $message = "You suspended a user";
        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));
        return redirect()->route('admin.view.users')
            ->with('success','User Suspended successfully!');
    }
    public function unsuspendUser($id){
        User::where('id',$id)
            ->update(['status' => 1]);
        //sending notification
        $message = "You unsuspended a user";

        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));
        return redirect()->route('admin.view.users')
            ->with('success','User Unsuspended successfully!');
    }
    public function approveUser($id){
        User::where('id',$id)
            ->update(['status' => 1]);
        //sending notification
        $message = "You approved a user";

        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));
        return redirect()->route('admin.view.users')
            ->with('success','User approved successfully!');
    }

    public function markAsRead(){

        foreach(auth()->user()->unReadNotifications as $notification){
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    public function roles(){
        $roles = Role::all();
        return view('admin.roles.role',compact('roles'));
    }

    public function role(Request $request){
        Role::create([
           'name' => $request->role
        ]);
        return redirect()->route('admin.roles')->with('success','Role added successfully');
    }

    public function roleDelete(Role $role){
        $role->delete();
        return redirect()->route('admin.roles')->with('success','Role deleted successfully');
    }

    // ====== Handle waste ======
    public function addWaste(){
        $wastes = Waste::all();
        $crops = Crop::all();
        return view('admin.waste.add',compact('wastes','crops'));
    }

    public function postWaste(Request $request){
        Waste::create([
            'name' => $request->waste,
            'crop_id' => $request->crop
        ]);
        return redirect()->route('admin.add.waste')->with('success','New waste added successfully!');
    }

    public function wasteDelete(Waste $waste){
        $waste->delete();
        return redirect()->route('admin.add.waste')->with('success','Waste deleted successfully');
    }

    //========== Handle Crop ===========
    public function addCrop(){
        $crops = Crop::all();
        return view('admin.crop.add',compact('crops'));
    }

    public function postCrop(Request $request){
        Crop::create([
           'name' => $request->crop
        ]);
        return redirect()->route('admin.add.crop')->with('success','Crop added successfully');
    }

    public function cropDelete(Crop $crop){
        $crop->delete();
        return redirect()->route('admin.add.crop')->with('success','Crop deleted successfully');
    }

    public function showWarehouse(Warehouse $warehouse){
        $warehouse->visible = 1;
        $warehouse->save();
        return redirect()->route('admin.view.warehouse')
            ->with('success','Warehouse successfully updated!');
    }

    public function hideWarehouse(Warehouse $warehouse){
        $warehouse->visible = 0;
        $warehouse->save();
        return redirect()->route('admin.view.warehouse')
            ->with('success','Warehouse successfully updated!');
    }

    public function showProduct(Product $product){
        $product->visible = 1;
        $product->save();
        return redirect()->route('admin.view.product')
            ->with('success','Product successfully updated!');
    }

    public function hideProduct(Product $product){
        $product->visible = 0;
        $product->save();
        return redirect()->route('admin.view.product')
            ->with('success','Product successfully updated!');
    }

    public function viewTruckers(){
        $truckers = Trucker::all();
        return view('admin.truck.view-tracker',compact('truckers'));
    }

    public function orders(){
        $orders = Order::all();
        return view('admin.orders.view-orders',compact('orders'));
    }

    public function orderDetail($order_id,$code){
        $order = Order::where('id',$order_id)->first();
        $order_details = OrderDetail::where('order_id',$order_id)->get();
        return view('admin.orders.view-order-detail',compact('order','order_details'));
    }

    public function confirmOrder($id){
        $order = Order::where('id',$id)->first();
        $order->update(['status' => 2]);

        $new_user = User::where('id',$order->user_id)->first();

        //sending notification
        $message = "You confirmed an order";
        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));


        $title = "Order";
        $message = "Your order has been confirmed!";
        Notification::send($new_user,new UserNotification($title,$message));

        return redirect()->route('admin.orders.view')->with('success','Order successfully confirmed!');
    }

    public function declineOrder($id){
        $order = Order::where('id',$id)->first();
        $order->update(['status' => 3]);

        $new_user = User::where('id',$order->user_id)->first();

        $message = "You declined an order";
        //database Notification
        Notification::send(auth()->user(),new AdminNotification($message));


        $title = "Order";
        $message = "Your order has been confirmed!";
        Notification::send($new_user,new UserNotification($title,$message));

        return redirect()->route('admin.orders.view')->with('success','Order successfully declined!');
    }

    public function informationSystem(){
        $data = User::all();
        return view('admin.user.information',compact('data'));
    }

    public function profile(){
        return view('admin.profile.profile');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password'  => 'required|min:7',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();
        $oldPassword = $request->old_password;
        $newPassword = $request->password;

        if (Hash::check($oldPassword,$user->password)){
            request()->user()->fill([
                'password' => Hash::make($newPassword)
            ])->save();
            $message = "Your password was changed!";
            Notification::send(\auth()->user(),new AdminNotification($message));
            request()->session()->flash('success','password changed successfully');

            return redirect(route('admin.profile'));
        }else{
            request()->session()->flash('error','Make sure you enter your right old password!');
            return redirect(route('admin.profile'));
        }
    }
}
