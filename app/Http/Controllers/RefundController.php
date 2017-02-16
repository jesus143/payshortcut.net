<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Refund;
use App\Order;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function execute(Request $request)
    {
        $parameter = Refund::composeParamater($request->except('_token'));
        // print "<pre>";
        $parameter = Refund::preparePostRequestEncryption($parameter);
        // print_r($parameter);
        $response  = Refund::sendPostRequest($parameter);
        // dd($response);
        if($response['Status'] == 'SUCCESS') {
            Order::find($request->get('id'))->update(['status'=>'Refunded Successfully', 'refund_response'=>serialize($response)]);
            return redirect()->back()->with('status', 'Product successfully refunded.');
        } else {
            return redirect()->back()->with('error', 'Ophs! something wrong! Status ' . $response['Status']);
        }
    }
}
