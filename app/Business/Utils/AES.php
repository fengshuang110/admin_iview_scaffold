<?php

namespace App\Business\Utils;

/**
 * AES 对称加密 解密
 * @author user
 *
 */
class AES{
     
    private $tokenEncryptMode = 'AES-256-ECB';
    
    public static function encode($data, $key) {
    	$data =  openssl_encrypt($data, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
    	return base64_encode($data);
    }
    
    public static function decode($data, $key) {
    	$encrypted = base64_decode($data);
    	return openssl_decrypt($encrypted, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
    }
}
?>
