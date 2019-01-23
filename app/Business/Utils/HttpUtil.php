<?php

namespace App\Business\Utils;

class HttpUtil
{
    public static function get(
        $url,
        $param = array(),
        $headers = array(),
        $cookie = '',
        $referer = '',
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
        $timeOut = 3
    ) {
        if (!empty($param)) {
            $url .= strstr('?', $url) ? '&' : '?';
            $url .= http_build_query($param);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_REFERER, $referer);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, false);
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);

        $content = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        return $content;
    }

    public static function post(
        $url,
        $param = '',
        $referer = '',
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)',
        $headers = array(),
        $timeOut = 3
    ) {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERAGENT, $agent);
        curl_setopt($curl, CURLOPT_REFERER, $referer);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (is_array($param)) {
            $param = http_build_query($param);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        
        $content = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        return $content;
    }
}