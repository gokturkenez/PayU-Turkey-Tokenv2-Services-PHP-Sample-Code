<?php
/**
 *Project: PayU Turkey Token v2 Services - Create Token with Ref No PHP Sample Code
 *Author: Göktürk Enez
 **/

$endpoint  = "https://secure.payu.com.tr/order/token/v2/merchantToken/";
$merchant=  "OPU_TEST";
$secret = "SECRET_KEY";
$timestamp = time();
$refNo = "57039798";

$arParams = array(
	"merchant" => $merchant,
	"refNo" => $refNo,
	"timestamp" => $timestamp,
);

$hashstring = '';
foreach ($arParams as $key => $val) {
	$hashString .=  $val;
}
$arParams["signature"] = hash_hmac("sha256", $hashString, $secret);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arParams));

$response = curl_exec($ch);
$curlerrcode = curl_errno($ch);
$curlerr = curl_error($ch);
print($response);
