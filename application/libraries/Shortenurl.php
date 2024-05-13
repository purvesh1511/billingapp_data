<?php

// Declare the class
class Shortenurl
{

    // Constructor
    function __construct()
    {
        $this->key = '';
    }

    function setkey($key)
    {

        $this->key = $key;
    }

    // Shorten a URL
    function shorten($url)
    {
        /*
        // Send information along
        $url_c= $url;

        $params=array('access_token'=>$this->key,'longUrl'=>$url_c);

        $url = 'https://api-ssl.bit.ly/v3/user/link_save?'. http_build_query($params);



        $result = json_decode($this->bitly_get_curl($url), true);
*/

        $api_url = "https://api-ssl.bitly.com/v4/bitlinks";
        $token = $this->key;
        $long_url = $url;

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["long_url" => $long_url]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]);

        $arr_result = json_decode(curl_exec($ch));
        //echo $arr_result->link;

        //print_r($arr_result);
        if(isset($arr_result->link))  return (string)$arr_result->link;

       // print_r($arr_result);

        return "BitLy ".$arr_result->description;


    }



    function bitly_get_curl($uri) {
        $output = "";
        try {
            $ch = curl_init($uri);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $output = curl_exec($ch);
        } catch (Exception $e) {
        }
        return $output;
    }

}