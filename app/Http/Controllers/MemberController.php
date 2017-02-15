<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Input;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $members = Member::orderBy('id', 'desc')->get();

//        dd($members);

        return view('pages/member/member', compact('members'));
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
     *
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
        $member = Member::find($id)->toArray();
        return view('pages/member/member-details', compact('member'));
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

    public function testing()
    {
        return view('pages/member/test');
    }

    public function apiStoreTest() {
        $memberInfoArray = [
            'first_name' =>  'Jesus Erwin',
            'last_name' =>  'Suarez',
            'email' =>  'mrjesuserwinsuarez@gmail.com',
            'telephone' =>  '+639069262984',
            'country' =>  'Philippines',
            'post_code' =>  '9200',
            'address' =>  'Mimbalot Buru un, Iligan City',
            'look_up' =>  'Nothing to look up',
            'uniform_number' =>  '1234567890',
            'status' => 'subscribed',
        ];

        $member = Member::create($memberInfoArray);
    }
    public function apiStore(Request $request)
    {
        $memberInfoArray = $request->all();
        // assign member email to a variable
        $member_email = $memberInfoArray['email'];
        // query member if exist already in payshortcut
        $totalMember = Member::where('email', $member_email)->count();
        // if member not exist then creaet new member and return the new created as array format
        if($totalMember  < 1) {
            $member = Member::create($memberInfoArray);
        } else {
            Member::where('email', $member_email)->update($memberInfoArray); 
        }

        $member = Member::where('email', $member_email)->first();

        return $member;
    }

    public function apiGetMember(){

        $id = Input::get('id');

        $member = Member::find($id);

        return $member;
    }

    public function apiGetMemberOrder()
    {
        $id = Input::get('id');

        $orders = Member::find($id)->order->toArray();

        $collection = collect($orders);

        $sorted = $collection->sortByDesc('id');

        return  $sorted->values()->all();
    }
}
