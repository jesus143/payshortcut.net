<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'country',
        'post_code',
        'address',
        'look_up',
        'uniform_number',
        'status',
    ];

    public static function getNameById($id)
    {
        $member = self::find($id);
        $fullName = $member->first_name .  ' ' . $member->last_name;
        return $fullName;
    }

    public static function test()
    {

    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }

}


