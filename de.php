<?php

$output = '';



$type = $_POST['type'];
$value = $_POST['value'];
$cipher = $_POST['cipher'];
function encrypt( $string, $action,$cipher) {
    
    $secret_key = 'decrypto';
    $secret_iv = 'decrypto';
 
    $output = false;
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, openssl_cipher_iv_length($cipher) );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $cipher, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $cipher, $key, 0, $iv );
    }
 
    return $output;
}



 
$output = encrypt($value,$type,$cipher);




$data = array(
    'result' => $output
);

echo json_encode($data);