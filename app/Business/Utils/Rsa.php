<?php
namespace App\Business\Utils;

/**
 * 
 * @author fengshuang
 *
 */
class Rsa
{
    /**
     * RSA签名 私钥签名
     * @param $data 待签名数据
     * @param $priKey 商户私钥
     * return 签名结果
     */
    function  rsaSign($data, $priKey) {
        $res = openssl_get_privatekey($priKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * RSA验签
     * @param $data 待签名数据
     * @param $pubKey 支付的公钥
     * @param $sign 要校对的的签名结果
     * return 验证结果
     */
    function rsaVerify($data, $pubKey, $sign)  {
        $res = openssl_get_publickey($pubKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
    
    /**
     * RSA加密
     * @param $data 待签名数据
     * @param $pubKey 支付的公钥
     * @param $sign 要校对的的签名结果
     * return 验证结果
     */
    function rsaEncrypt($content, $pubKey){
        $res = openssl_get_publickey($pubKey);
        //把需要加密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content)/128; $i++  ) {
            $data = substr($content, $i * 128, 128);
            openssl_public_encrypt ($data, $encrypt, $res);
            $result .= $encrypt;
        }
        $result = base64_encode($result);
        openssl_free_key($res);
        return $result;
    }
    
    /**
     * RSA解密
     * @param $content 需要解密的内容，密文
     * @param $private_key_path 商户私钥文件路径
     * return 解密后内容，明文
     */
    function rsaDecrypt($content, $priKey) {
        $res = openssl_get_privatekey($priKey);
        //用base64将内容还原成二进制
        $content = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content)/128; $i++  ) {
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }
}