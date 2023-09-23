<?php

require('vendor/autoload.php');

$PATH = __DIR__.'/';
$dotenv = Dotenv\Dotenv::createImmutable($PATH); // Replace __DIR__ with the path to your .env file if it's located elsewhere

$dotenv->load();

$MASTERKEY = $_ENV['MASTERKEY'];

$TEST_PUBLICKEY = $_ENV['TEST_PUBLICKEY'];
$TEST_PRIVATEKEY = $_ENV['TEST_PRIVATEKEY'];
$TEST_TOKEN = $_ENV['TEST_TOEKN'];

$LIVE_PUBLICKEY = $_ENV['LIVE_PUBLICKEY'];
$LIVE_PRIVATEKEY = $_ENV['LIVE_PRIVATEKEY'];
$LIVE_TOKEN = $_ENV['LIVE_TOKEN'];

    # Live
    // $master_key = $MASTERKEY;
    // $private_key = $LIVE_PRIVATEKEY;
    // $token = $LIVE_TOKEN;

    # Dev
    $master_key = $MASTERKEY;
    $private_key = $TEST_PRIVATEKEY;
    $token = $TEST_TOKEN;

    $data = array(
        'account_alias' => '771111111',
        'amount' => 400,
        'withdraw_mode' => 'orange-money-senegal',
    );

    $ch = curl_init('https://app.paydunya.com/api/v1/disburse/get-invoice');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'PAYDUNYA-MASTER-KEY: ' . $master_key,
        'PAYDUNYA-PRIVATE-KEY: ' . $private_key,
        'PAYDUNYA-TOKEN: ' . $token,
    ));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        echo $response;
    }

curl_close($ch);
?>
