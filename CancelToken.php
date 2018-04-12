<?php
/**
*Project: PayU Turkey Token v2 Services - Cancel Token PHP Sample Code
*Author: Göktürk Enez
 **/

$merchant=  "OPU_TEST";
$secret = "SECRET_KEY";
$timestamp = time();
$cancelReason = "Test";
$token = "0832a14fed117d974d7e801fcaffbf6e";

$hashstring = '';
$hashstring = $cancelReason . $merchant . $timestamp;

$sig = hash_hmac('sha256', $hashstring,$secret);

$endpoint  = "https://secure.payu.com.tr/order/token/v2/merchantToken/".$token."?merchant=".$merchant."&timestamp=".$timestamp."&signature=".$sig."&cancelReason=".$cancelReason;
$method = 'DELETE';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "$method");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_POST, 1);

$response = curl_exec($ch);
$curlerrcode = curl_errno($ch);
$curlerr = curl_error($ch);
print_r($response);

