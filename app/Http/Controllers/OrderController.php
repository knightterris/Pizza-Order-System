<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                        ->when(request('key'),function($query){
                            $query->orWhere('user_id','like','%'.request('key').'%')
                                ->orWhere('order_code','like','%'.request('key').'%')
                                ->orWhere('name','like','%'.request('key').'%')
                                ->orWhere('total_price','like','%'.request('key').'%');
                        })
                        ->leftJoin('users','users.id','orders.user_id')
                        ->get();
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }
    //sort with ajax
    public function changeStatus(Request $request){
        // dd($request->all());
        // logger($request->all());
        // $request->status = $request->status == null ? "" : $request->status;
        // logger($request->status);
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id');

                        if($request->orderStatus == null){
                            $order = $order->get();
                        }else{
                            $order = $order->where('orders.status',$request->orderStatus)->get();
                        }
                        return view('admin.order.list',compact('order'));
    }
    //ajaxChangeStatus

    public function ajaxChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
        $order = Order::select('orders.*','users.name as user_name')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->get();
                        return response()->json($order,200);
    }
    //listInfo
    public function listInfo($orderCode){
        // dd($orderCode);
        $order = Order::where('order_code',$orderCode)->first();
        // dd($orderCode);
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                                ->leftJoin('users','users.id','order_lists.user_id')
                                ->leftJoin('products','products.id','order_lists.product_id')
                                ->where('order_code',$orderCode)->get();
        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }
}
