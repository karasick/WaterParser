<?php
namespace Parser\cURL;

        class cURLOptions{

                public static function SetOptions($url){

                    $options = array(CURLOPT_URL => $url, 
                                    CURLOPT_REFERER => "https://www.google.com.ua/",
                                    CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36 Edge/16.16299",
                                    CURLOPT_HEADER => 0,
                                    CURLOPT_FOLLOWLOCATION => 1,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_TIMEOUT => 30);

                        return $options; 
                }
            
        }

?>