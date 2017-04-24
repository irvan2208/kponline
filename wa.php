<?php
$CLIENT_ID = "TRIAL_ACCOUNT";  // No need to change until you subscribe to the Forever Green plan
$CLIENT_SECRET = "PUBLIC_SECRET";   // No need to change until you subscribe to the Forever Green plan
$postData = array(
  'number' => '+6283184476796',  //  Specify the recipient's number here. NOT the gateway number
  'message' => 'Howdy! Is this exciting?'
);
$headers = array(
  'Content-Type: application/json',
  'X-WM-CLIENT-ID: '.$CLIENT_ID,
  'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
);
$url = 'http://api.whatsmate.net/v1/whatsapp/single/message/2';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);
echo "Response: ".$response;
curl_close($ch);
?>	