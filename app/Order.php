<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Setting;
use App\Order;

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
        'refund_response',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public static function getPaymentMethod($order)
    {
        $content_post  = unserialize($order['content_post']);
        return  $content_post['PaymentType'];
    }
    public static function getIpAddress($order)
    {
        $content_post  = unserialize($order['content_post']);

        return  $content_post['IP'];
    }

    public static function composeNewOrder($latestOrder)
    { 
        // remove id and create, updated dates
        unset($latestOrder['id']);
        unset($latestOrder['created_at']);
        unset($latestOrder['updated_at']); 
        $latestOrder['status'] = '授權成功 - SUCCESS'; 
        $latestOrder['merchant_order_no'] = rand(9999999999,99999999999);  
        return $latestOrder;  
    }
    public static function triggerSpgatewayAgreedBill($order, $member, $globalContent)
    { 
 
        // compose spgateway data   
        $postDate    = []; 
        $url         = ''; 
        $merchant_id =  $globalContent['merchant_id']; //'MS3709347'; //  商店代號
        $key         = $globalContent['hash_key']; //"YK5drj7GZuYiSgfoPlc24OhHJj5g6I35"; //<----  請填入該商店代號的 Key 值
        $iv          =  $globalContent['hash_iv']; //"t8jUsqArVyJOPZcF"; //    <----  請填入該商店代號的  iv  值
        $gateway     = $globalContent['payment_url']; //"https://ccore.spgateway.com/API/CreditCard"; // 測試主機
        //$gateway="https://core.spgateway.com/API/CreditCard"; // 正式主機
        $pos =  $globalContent['response_type']; //"JSON"; //  此範例可為  JSON  或  String  //====以下為副程式====
   
    $input_array = array(
        'Version'          => "1.0", //版本號
        'ProdDesc'         => $order['title'], //"Send Right Light 250000", //商品名稱資訊
        'Amt'              => $order['amt'], // "5980", //金額
        'MerchantOrderNo'  => rand(9999999999,99999999999), //$order['merchant_order_no'], //rand(9999999999,99999999999), // 覆
        'TimeStamp'        => time(), //時間戳記
        'PayerEmail'       => $member->email, //"mrjesuserwinsuarez@gmail.com",    //付款人 Email
        'TokenValue'       => $order['token_value'],  //"97ef0269affe85cee882fa132533813b0f19db16cb28a61f20aabedd86dd0ffb", //Token 類別
        'TokenTerm'        => $member->email, //"mrjesuserwinsuarez@gmail.com", //約定信用卡付款之付款人綁定資料
        'TokenSwitch'      => "on", //約定信用卡付款之有效日期
    ); 

    $post_data_str = http_build_query($input_array);
    $post_data = self::spgateway_encrypt($key, $iv, $post_data_str); //加密函式 
    
    // foreach ($input_array as $key => $value) {
    //     $spgateway_args_array[] = '<input type="text" name="' . stripcslashes($key) . '" value="' . stripcslashes($value) . '" /><br>';
    // } 
    // $def_url = '<form method="POST" action="' . $gateway . '">';
    // //$def_url .=  implode('', $spgateway_args_array);
    // $def_url .= "MerchantID_ <input type='text' name='MerchantID_' value='" . $merchant_id . "'><br>";
    // $def_url .= "Pos_ <input type='text' name='Pos_' value='" . $pos . "'><br>";
    // $def_url .= "PostData_ <input type='text' name='PostData_' value='" . $post_data . "'><br>";
    // $def_url .= "<input type='submit' value='前往授權'>";
    // $def_url .= "</form><br />";
    // echo $def_url;
 
        $postData = [
            'MerchantID_' => $merchant_id, 
            'Pos_' => $pos, 
            'PostData_' => $post_data
        ];
 
        //  trigger automatic spgateway bill
        $response = curlPostRequest($postData, $gateway); 
 
        return $response;
  

    }


    private static function spgateway_encrypt($key = "", $iv = "", $str = "") {
        $str = trim(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, self::addpadding($str), MCRYPT_MODE_CBC, $iv)));
        return $str;
    }

    protected static function addpadding($string, $blocksize = 32) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    } //====以上為副程式====

    public static function getMemberOrderByTitle($user_id, $product_title){
        $orders = Order::where('member_id', $user_id)->where('title', 'like',  "%" . $product_title . "%")->orderBy('id', 'desc')->get()->first(); 

        if(!empty($orders)) {  
            return $orders->toArray(); 
        } else {
            return false;
        }
        

    } 
    
}
