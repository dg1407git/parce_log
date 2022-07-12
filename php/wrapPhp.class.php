<?php

class wrapPhp {
    function explode($delimetr, $string){
        return explode($delimetr, $string);
    }
    function empty($value){
        return empty($value);
    }
    function strpos($haystack, $needle){
        return strpos($haystack, $needle);
    }
    function ucfirst($string){
        return ucfirst($string);
    }
    function count($array){
        return count($array);
    }
    function json_encode($value){
        return json_encode($value);
    }
    function trim($string){
        return trim($string);
    }
    function file($string){
        return file($string);
    }
    function str_replace($search, $replace, $subject){
        return str_replace($search, $replace, $subject);
    }
    function fopen($string, $mode){
        return fopen($string, $mode);
    }
    function fgets($handle){
        return fgets($handle);
    }
    function fclose($handle){
        return fclose($handle);
    } 
}

?>