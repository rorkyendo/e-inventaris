<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('Send_SMS'))
{
  function Send_SMS( $to, $text ) {
  #example $to=”628xxxx,628xxxx”;

  $to = str_replace(' ',"",$to);
  $from = "Dari siapa"; //Sender ID or SMS Masking Name, if leave blank, it will use default from telco
  $username_pengguna = "username_pengguna nya "; //your username_pengguna
  $password_pengguna = "password_pengguna nya"; //your password_pengguna
  $getUrl = "http://103.81.246.59:20003/sendsms?";
  $ch = curl_init();
  $apiUrl = $getUrl.'account='.$username_pengguna.'&password_pengguna='.$password_pengguna.'&numbers='.$to.'&content='.rawurlencode($text);

  curl_setopt( $ch, CURLOPT_URL, $apiUrl);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json',
  'Accept:application/json'
  )
  );

  $response = curl_exec( $ch );
  $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
  $responseBody = json_decode( $response, true );

  if ($response) {
    echo $response;
  }
    curl_close($ch);
  }
}
