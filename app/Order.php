<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'member_id',
        'status',
        'title',
        'description',
        'merchant_id',
        'version',
        'response_type',
        'check_value',
        'time_stamp',
        'merchant_order_no',
        'amt',
        'hash_key',
        'hash_iv',
        'trade_no',
        'token_value',
        'token_life',
        'content_post',
        'content_session',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }
}
