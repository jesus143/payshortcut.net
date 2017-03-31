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

    public function apiGetMemberOrderByTitle($user_id, $product_title)
    {
        $orders = Order::where('member_id', $user_id)->where('title', $product_title)->orderBy('id', 'desc')->get()->first()->toArray();

        return $orders;
    }
}
