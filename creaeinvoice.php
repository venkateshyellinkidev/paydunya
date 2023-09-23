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

\Paydunya\Setup::setMasterKey($MASTERKEY);
\Paydunya\Setup::setPublicKey($TEST_PUBLICKEY);
\Paydunya\Setup::setPrivateKey($TEST_PRIVATEKEY);
\Paydunya\Setup::setToken($TEST_TOKEN);
\Paydunya\Setup::setMode("test"); // Optionnel en mode test. Utilisez cette option pour les paiements tests.


// API endpoint
$apiEndpoint = 'https://app.paydunya.com/api/v1/checkout-invoice/create';

// API credentials
$masterKey = 'w45AVPgF-JqMA-W45K-gGJm-XorU2n7bh8rU'; 

// live keys

$privateKey = 'live_private_nRQc6KdhZm2IDi0c6Vk4W0YvQZD';//
$token = 'KB77OHowBkyb04C1vdmb';  // QUq2D7Ot9RW173IWXATM

// test credentials 

// $privateKey = 'live_private_nRQc6KdhZm2IDi0c6Vk4W0YvQZD';//
// $token = "QUq2D7Ot9RW173IWXATM";

// Request data
$data = [
    'invoice' => [
        'total_amount' => 400,
        'description' => 'mypass hotel payment',
    ],
    'store' => [
        'name' => 'mypass',
    ],
];

// Create cURL resource
$ch = curl_init($apiEndpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'PAYDUNYA-MASTER-KEY: ' . $masterKey,
    'PAYDUNYA-PRIVATE-KEY: ' . $privateKey,
    'PAYDUNYA-TOKEN: ' . $token,
]);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
}

// Close cURL resource
curl_close($ch);

// Parse the JSON response
$responseData = json_decode($response, true);

// Process the response
if ($responseData['response_code'] === '00') {
    echo 'Invoice created successfully. Invoice URL: ' . $responseData['response_text'];
} else {
    echo 'Invoice creation failed: ' . $responseData['description'];
}

?>
