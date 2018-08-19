<?php
namespace Parser;
use Parser\cURL\cURLOptions;
use Parser\Database\Functions;
use Parser\Exceptions\DataExceptions;
use Parser\Exceptions\cURLExceptions;

class ParserAPI {

    public static function ParseNew($link = NULL) {

        $ch = curl_init(); // create cURL handle (ch)
        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }
        $infof = fopen("info.txt", "w+"); // open file to load data
    
        curl_setopt($ch, CURLOPT_FILE, $infof); // set some cURL options 
        $instance = "https://www.anilibria.tv/tracker/relizy.php";
        curl_setopt_array($ch, cURLOptions::SetOptions('' . $instance));

        $ret = curl_exec($ch); // execute

        if(cURLExceptions::IfEmpty($ret, $ch, $infof) == TRUE) {
            die("No HTTP code was returned");
        } else {
            $info = curl_getinfo($ch); 
            curl_close($ch); // close cURL handler
            fclose($infof); // close file

            $dom = str_get_html($ret);
            $course1 = $dom->find(".torrent_name");
            $course2 = $dom->find(".torrent_full_descr");

            for($i = 0, $n_id = 1; $i < count($course1); $i++) {
                $release[$i] = trim(strval($course1[$i]->plaintext));

                $preparts = explode(":", $course2[$i]);
                $part_1 = explode("-", $preparts[0]);
                if(count($preparts) == 1){
                    $part_1 = explode(" ", $preparts[0]);
                }
                $amount[$i] = $part_1[1];

                if(count($preparts) > 2) {
                    $preparts[1] .= ":" . $preparts[2];
                }
                $part_2 = explode("<br/>", $preparts[1]);
                $current[$i] = trim($part_2[1]);

                $id[$i] = $i+$n_id;
                echo $i+$n_id . "<br/>";

                $date[$i] = intval(date("ymdHi"));

                $a_release = $course1[$i]->find('a', 0);
                $rlink[$i] = "https://www.anilibria.tv" . $a_release->href;

                $a_torrent = $course2[$i]->find('a', 0);
                $tlink[$i] = "https://www.anilibria.tv" . $a_torrent->href;
                
                if(Functions::SetReleases($link, $release[$i], $amount[$i], $current[$i], $rlink[$i], $tlink[$i], $id[$i], $date[$i]) == 1062) {
                    $n_id--;
                }
            }
            Functions::SetIds($link);
        }
    }
}
?>