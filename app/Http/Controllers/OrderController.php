<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::orderBy('id', 'desc')->get();



        return view('pages/order/order', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id)->toArray();

        return view('pages/order/order-details', compact('order', 'content_post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apiStore(Request $request)
    {
        $orderInfoArray  =  $request->all();

        // create new order with member id
        $order = Order::create($orderInfoArray);

        // return new created order
        return $order;
    } 

    public function getOrderDetail($id) 
    { 
        $order = Order::find($id)->toArray();  
        return $order; 
    } 

    /**
     * [apiGetMemberOrderByTitle get latest subscription of specific user and can be called as api in sendright subscription]
     * @param  [type] $user_id       [This is the specific user ping or deactivated]
     * @param  [type] $product_title [ This is to set the of the query] 
     */
    public function apiGetMemberOrderByTitle($user_id, $product_title)
    {
        $orders = Order::where('member_id', $user_id)->where('title', $product_title)->orderBy('id', 'desc')->get()->first()->toArray(); 
        return $orders;
    }   

    /**
     * [updateSubscriptionStatus This will allow subscription update status to deactivate and call be called as api in spgateway cancell subscription credit card]
     * @param  [type] $id [order id passed from a ping] 
     */
    public function updateSubscriptionStatus($id)
    {  
        // instantiate
        $order = Order::find($id);      
        
        // update status to deactivated 
        $response = $order->update(['status' => 'deactivated']);    
             
        if($response) {   
            return json_encode(['response'=>'update success', 'order_id'=>$id]);
        } else {
            return json_encode(['response'=>'update failed', 'order_id'=>$id]); 
        } 
    } 
} 
