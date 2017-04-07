<?php 
 
use Carbon\Carbon; 





function human_readable_date_time($date)
{
    return date("F j, Y, g:i a", strtotime($date));
} 

function print_r_pre($array, $title='')
{
    print "<pre>"; 
        print "\n" . $title;
        print_r($array); 
    print "</pre>"; 
}
function createDateTimeCarbon($dateTime)
    { 
        if(empty($dateTime)) {
            $dateTime = Carbon::now(); 
        }  
 
        $d1   = explode(" ", $dateTime); 
        $date = explode("-", $d1[0]); 
        $time = explode(":", $d1[1]); 
     
        $hour = $time[0];
        $min  = $time[1];
        $sec  = $time[2]; 

        $year  = $date[0];
        $month = $date[1];
        $day   = $date[2];
        
        $explodedDateTime = ['year'=>$year, 'month'=>$month, 'day'=>$day, 'hour'=>$hour, 'min'=>$min, 'sec'=>$sec]; 
  
        return Carbon::create($explodedDateTime['year'], $explodedDateTime['month'], $explodedDateTime['day'],  $explodedDateTime['hour'], $explodedDateTime['min'], $explodedDateTime['sec']); 
    }



function getLimitStart($page=0, $limit=5) { 
        $limit_start = 0;       
        $limit_end   = 0;       
        // $limit       = 5; 
     
        if($page == 0) {   
            $limit_start = 0;
            $limit_end   = $limit;   
        } else { 
            $limit_start = $limit * $page; 
            $limit_end = $limit;  
        }   
        return $limit_start;
}

function getLimitEnd($page=0, $limit=5) { 
        $limit_start = 0;       
        $limit_end   = 0;       
        // $limit       = 5; 
     
        if($page == 0) {   
            $limit_start = 0;
            $limit_end   = $limit;   
        } else { 
            $limit_start = $limit * $page; 
            $limit_end = $limit;  
        }   
        return $limit_end;
}

 



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
    
    //    print "<Br> post request data";
    //    print_r($postData);
    //    print "<br> url " . $url;


    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch); 
    
    // do anything you want with your response
    // var_dump($response);

 
    return json_decode($response, true);
}

/**
 * @src http://codular.com/curl-with-php
 * @param $getData
 * @param $url
 * @return mixed
 */
    function curlGetRequest($getData, $url, $type="")
    {
        if($type!='full') {
            $getData = http_build_query($getData, "", "&");
            $url = $url . '?' . $getData;
        }


        print " full url " . $url; 

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