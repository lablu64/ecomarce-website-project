<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\shippinginfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function CategoryPages($id){
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id',$id)->latest()->get();
        return view('user_temp.categorypages',compact('category','products'));
    }
    public function SingleProduct($id){
        $product = Product::findOrFail($id);
        $subcate_id = Product::where('id',$id)->value('product_subcategory_id');
       $related_products =Product::where('product_subcategory_id',$subcate_id)->latest()->get();
        return view('user_temp.sigleproduct' , compact('product','related_products'));
    }
    public function AddToCart(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();

        return view('user_temp.addtocart',compact('cart_items'));
    }
    public function Checkout(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        $shiping_address = shippinginfo::where('user_id',$userid)->first();

        return view('user_temp.checkout',compact('cart_items' ,'shiping_address'));
    }

    public function PlaceOrder(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id',$userid)->get();
        $shiping_address = shippinginfo::where('user_id',$userid)->first();

        foreach($cart_items as $item){
            Order::insert([
                'userid' => $userid,
                'shoping_phonNumber' => $shiping_address->phone_number ,
                'shoping_city' => $shiping_address->city_name ,
                'shoping_posterCode' =>$shiping_address->poster_name,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_Price' =>$item->price,
            ]);
            $id = $item->id;
           Cart::findOrFail( $id)->delete();
        }

        shippinginfo::where('user_id',$userid)->first()->delete();

        return redirect()->route('pendingorders')->with('message',' Your order has been placed successfully !');

    }
    public function UserProfile(){
        return view('user_temp.userprofile');
    }
  
    public function PendingOrders(){
        $pending_orders =Order::where('status','pending')->latest()->get();
        //$pending_userid =Order::where('userid','pending')->latest()->get();
        return view('user_temp.pendingorders',compact('pending_orders'));
    }
    public function History(){
        return view('user_temp.history');
    }
    public function AddProductToCart(Request $request){
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;
        
        Cart::insert([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(),
            'price' => $price,
        ]);
        return redirect()->route('addtocart')->with('message',' Product item added successfully !');

       
    }

    public function NewRelease(){
        return view('user_temp.newrelease');
    }
    public function TodaysDeal(){
        return view('user_temp.todaysdeal');
    }
    public function CustomerServices(){
        return view('user_temp.customerservices');
    }
    public function RemoveCardItem($id){
        Cart::findOrFail( $id)->delete();
        return redirect()->route('addtocart')->with('message','Product item delete successfully');
    }
    public function GetShippingAddress(){
        return view('user_temp.shippingaddress'); 
    }
    public function AddShippingAddress(Request $request){
        shippinginfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' =>$request->city_name,
            'poster_name' => $request->poster_name,
        ]);
        return redirect()->route('checkout')->with('message','Product item delete successfully');
   
    }
}
