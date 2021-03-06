<?php

$memberInfo = [
    'first_name' =>  '1eJesus Erwin',
    'last_name' =>  '1weSuarez',
    'email' =>  'mrjesuserwinsuarez@gmail.com',
    'telephone' =>  '+639069262984',
    'country' =>  'Philippines',
    'post_code' =>  '9200',
    'address' =>  'Mimbalot Buru un, Iligan City',
    'look_up' =>  'Nothing to look up',
    'uniform_number' =>  '1234567890',
    'status' => 'subscribed',
];

$orderInfo = [
    'status' => 'success',
    'merchant_id' => '1234567',
    'version' => '1.1',
    'response_type' => 'String',
    'check_value' => '1234456789',
    'time_stamp' => date("Y-m-d h:i:s"),
    'merchant_order_no' => '123',
    'amt' => '100',
    'hash_key' => '1234dasda',
    'hash_iv' => 'ASD123',
    'trade_no' => '12321',
    'token_value' => '2asdasd',
    'token_life' => '1233232',
];

print "<pre>";

$member  = curlPostRequest($memberInfo, url('api/member/create'));
print "<br>member<br>";
print_r($member);

$orderInfo['member_id'] = $member['id'];
$order = curlPostRequest($orderInfo, url('api/order/create'));

print "<br>order<br>";
print_r($order);

print "<br>order<br>";
$getMember              = curlGetRequest(['id'=>82], url('api/member/get'));
print_r($getMember);

print "<br>order<br>";
$getMemberOrder         = curlGetRequest(['id'=>82], url('api/member/get/order'));
print_r($getMemberOrder);