<?php 
namespace  App\Business\Utils;

class Tool {
	
	public static function getClientIp()
	{
		$uip = '';
		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], 'unknown')) {
			$uip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			strpos($uip, ',') && list($uip) = explode(',', $uip);
		} else if(!empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], 'unknown')) {
			$uip = $_SERVER['HTTP_CLIENT_IP'];
		} else if(!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$uip = $_SERVER['REMOTE_ADDR'];
		}
		return $uip;
	}

    public static function str2PublicKey($str)
    {
        $str = trim($str);
        $key = chunk_split($str, 64, "\n");
        return "-----BEGIN PUBLIC KEY-----\n". $key ."-----END PUBLIC KEY-----";        
    }

    public static function str2PrivateKey($str)
    {
        $str = trim($str);
        $key = chunk_split($str, 64, "\n");
        return "-----BEGIN RSA PRIVATE KEY-----\n". $key ."-----END RSA PRIVATE KEY-----\n";        
    }

     public static function microtime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

}

?>