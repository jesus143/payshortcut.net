<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Setting;

class Refund extends Model
{
    protected $table = 'refunds';





    public static function composeParamater($parameter=[])
    {
        // set parameter
        $marchant_id     = Setting::where('key', 'marchant_id')->first()->value;
        $hash_key        = Setting::where('key', 'hash_key')->first()->value;
        $hash_iv         = Setting::where('key', 'hash_iv')->first()->value;
        $refund_sandbox  = Setting::where('key', 'refund_sandbox')->first()->value;
        $closeType            = 'refund';
        $indexType            = 1;
        $version              = 1.0;
        $postData_            = '';
        $respondType            = 'JSON';

        // conditional for parameter for sandbox or not
        if($refund_sandbox == 'yes')
        {
            $url = 'https://ccore.spgatewaY.com/API/CreditCard/Close';
        }
        else
        {
            $url = 'https://core.spgatewaY.com/API/CreditCard/Close';
        }

        // assign to an array
         $data = [
             'MerchantID_' => $marchant_id,
             'PostData_' => $postData_,
             'RespondType' => $respondType,
             'Version' => $version,
             'Amt' =>  $parameter['amt'],
             'MerchantOrderNo' =>  $parameter['merchant_order_no'],
             'TimeStamp' => time(),
             'IndexType' => $indexType,
             'TradeNo' =>  $parameter['trade_no'],
             'CloseType' => $closeType,
             'HashIV' => $hash_iv,
             'HashKey' => $hash_key,
             'url' => $url,
         ];

        // return
        return $data;

    }

    public static function preparePostRequestEncryption($parameter)
    {
        $post_data_str = http_build_query($parameter, '', '&');
        $parameter['PostData_'] = trim(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128,  $parameter['HashKey'], addpadding($post_data_str), MCRYPT_MODE_CBC, $parameter['HashIV'])));

         return $parameter;

    }

    public static function sendPostRequest($parameter)
    {
        return curlPostRequest($parameter ,$parameter['url']);
    }

}
