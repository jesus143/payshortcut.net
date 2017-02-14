<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';


    public static function getNameById($id)
    {
        $member = self::find($id);
        $fullName = $member->first_name .  ' ' . $member->last_name;
        return $fullName;
    }


}


