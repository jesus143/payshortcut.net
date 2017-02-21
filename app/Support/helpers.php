<?php

function changeDashToSpaceUcLetter($string)
{
    $string = str_replace('_', ' ', $string);
    return ucfirst($string);
}

/**
 * @src http://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code
 * @param $postData
 * @return mixed
 */
function curlPostRequest($postData, $url)
{
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

/**
 * @src http://codular.com/curl-with-php
 * @param $getData
 * @param $url
 * @return mixed
 */
function curlGetRequest($getData, $url) {

    $getData = http_build_query($getData, "", "&");

    $url = $url . '?' . $getData;

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $output=curl_exec($ch);

    curl_close($ch);

    return json_decode($output, true);
}

function addpadding($string, $blocksize = 32) {
    $len = strlen($string);
    $pad = $blocksize - ($len % $blocksize);
    $string .= str_repeat(chr($pad), $pad);
    return $string;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}