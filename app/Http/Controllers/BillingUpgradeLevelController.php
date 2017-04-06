<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillingUpgradeLevel;



class BillingUpgradeLevelController extends Controller
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

        // get total results if check email and order id exist already
        $isAlreadySetUpgradeLevel = BillingUpgradeLevel::where('email', $request->get('email'))->where('order_id', $request->get('order_id'))->count();
 
        // insert to level upgrade if not exist
        if($isAlreadySetUpgradeLevel == false) {
            BillingUpgradeLevel::create($request->all());
        }
 
        // get latest billing upgrade of the specific user
        $latestUpgrade = BillingUpgradeLevel::where('email', $request->get('email'))->where('order_id', $request->get('order_id'))->get()->toArray();

        return $latestUpgrade;
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
}
