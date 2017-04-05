<?php

    $spgateway_gateway = 'https://ccore.spgatewaY.com/API/CreditCard/Close';
    //    $url = 'https://core.spgatewaY.com/API/CreditCard/Close';

    $data = [
        'MerchantID_' => 'MS3709347',
        'PostData_' => '',
        'RespondType' => 'JSON',
        'Version' => '1.0',
        'Amt' => 100,
        'MerchantOrderNo' => 227,
        'TimeStamp' => time(),
        'IndexType' => 1,
        'TradeNo' => 17021514261175963,
        'CloseType' => 'refund',
        'HashIV' => 't8jUsqArVyJOPZcF',
        'HashKey' => 'YK5drj7GZuYiSgfoPlc24OhHJj5g6I35',
    ];

    function addpadding($string, $blocksize = 32) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }

    $post_data_str = http_build_query($data, '', '&');
    $data['PostData_'] = trim(bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $data['HashKey'], addpadding($post_data_str), MCRYPT_MODE_CBC, $data['HashIV'])));


    print_r(curlPostRequest($data ,'https://ccore.spgateway.com/API/CreditCard/Close'));

    function curlPostRequest($postData, $url)
    {
        print "helper 2";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // do anything you want with your response
        var_dump($response);

        return json_decode($response, true);
    }






