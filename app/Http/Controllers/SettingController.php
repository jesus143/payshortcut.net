<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marchant_id     = Setting::where('key', 'marchant_id')->first()->value;
        $hash_key        = Setting::where('key', 'hash_key')->first()->value;
        $hash_iv         = Setting::where('key', 'hash_iv')->first()->value;
        $refund_sandbox  = Setting::where('key', 'refund_sandbox')->first()->value;

        $settings = [
            'marchant_id' =>$marchant_id,
            'hash_key' =>$hash_key,
            'hash_iv' =>$hash_iv,
            'refund_sandbox' =>$refund_sandbox,
        ];

        return view('pages/setting/spgateway-refund', compact('settings'));
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
        $data = $request->except('_token');
        foreach($data as $key => $value ){
            $total = Setting::where('key', $key)->count();
            if($total  < 1) {
                Setting::create(['key'=>$key, 'value'=>$value]);
            } else {
                Setting::where('key', $key)->update(['key'=>$key, 'value'=>$value]);
            }
        }

        return redirect()->back()->with('status', 'Successfully updated');
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
