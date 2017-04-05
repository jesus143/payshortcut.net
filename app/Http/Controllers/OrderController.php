<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Member;

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
    
        // order info array
        $orderInfoArray  =  $request->all(); 

        // create new order with member id
        $order = Order::create($orderInfoArray);
    
        // only create sendright account if purchased sendright product
        if( strpos(strtolower($request->get('title')), 'send right lite') > -1) {  
            // create user sendright account
            $this->createNewSendirhgtAccount($request->get('member_id'));  
        } 
        
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
        $orders = Order::where('member_id', $user_id)->where('title', 'like',  "%" . $product_title . "%")->orderBy('id', 'desc')->get()->first()->toArray(); 
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


    public function testCreate()
    {

        $orderInfo = [
            'member_id' => 36,
            'status' => 'success',
            'merchant_id' => '1234567',
            'version'        => '1.1',
            'response_type' => 'String',
            'check_value' => '1234456789',
            'time_stamp' => date("Y-m-d h:i:s"),
            'merchant_order_no' => '123',
            'amt' => '100',
            'hash_key' => '1234dasda',
            'hash_iv' => 'ASD123',
            'trade_no' => '12321',
            'token_value' => '2asdasd',
            'token_life' => '1233232',
        ]; 
        // print "<pre>";
        // print_r($orderInfo); 
        // print "</pre>"; 
        curlPostRequest($orderInfo, url('api/order/create'));  
       
    }
 
    public function createNewSendirhgtAccount($member_id)
    { 
        /**
         * This function allow to create account in sendright, when purchase a product from woocomerce
         * [$member_id this is the member id] 
         */
        // $member_id = $orderInfo['member_id'];   
        $member    = Member::find($member_id); 
        $email     = $member->email;  
        $fullname  =  ucfirst(strtolower($member->first_name)) . ' ' . ucfirst(strtolower($member->last_name)); 
        $password  = 'secret';   
        $user['email']    = $email;
        $user['name']     = $fullname;
        $user['password'] = $password; 
        print "<pre>"; 
        print_r($user); 
        curlPostRequest($user, 'http://sendright.net/api/user-new/create-post');  
        // curlGetRequest(null, 'http://sendright.net/api/user-new/create/' . $email . '/'. $fullname . '/' . $password, 'full');   

    }
} 
