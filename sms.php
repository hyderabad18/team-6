<?php
require __DIR__ . '/twilio-php-master/Twilio/autoload.php';
use Twilio\Rest\Client;


$account_sid = 'AC46bd4b8162f3153166421ca36d784630';
$auth_token = '48c26a2af73548fed0eb615de82de3a8';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with SMS capabilities
$twilio_number = "8325013846";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    '+917981006917',
    array(
        'from' => $twilio_number,
        'body' => 'hey its working'
    )
);

?>