<?php
namespace Parser\Database;

class Including {
    
    public static function GetLink() {

        #$url = "";

        $server = 'localhost';
        $username = 'id6262473_karasick';
        $password = 'm91tnaya';
        $db = 'id6262473_waterparserdb';

        $link = mysqli_connect($server, $username, $password, $db);

        if(mysqli_connect_errno()) {
            echo "Error (" . mysqli_connect_errno() . "): " . mysqli_connect_error();
            exit();
        }

        return $link;
    }   
}

?>