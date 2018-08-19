<?php
namespace TelegramServer\Methods;

class SetOptionsFrom {

    public static function Command($sendmessage_options = NULL, $command = NULL, $command_type = "badcommand", $releases = NULL) {

        $today_date = intval(date("ymd") . "0000");
        $current_weekstart_date = intval(date("ymd") . "0000") - ((intval(date("N")) - 1) * 10000 );

        switch($command_type) {
            /*case "integer": {
                if($command <= count($releases)) {
                    $sendmessage_options['response'] = "New episode: " . $releases[intval($command)-1]['current'] . "\n" . $releases[intval($command)-1]['rlink'];
                    $sendmessage_options['keyboard'] = [
                        'inline_keyboard' => [
                            [
                                ['text' => 'Torrent link', 'url' => $releases[intval($command)-1]['tlink']]
                                # 'url' => $releases[$message[1]-1]['tlink'], 'callback_data' => 'someString'
                            ]
                        ]
                    ];
                } else {
                    $sendmessage_options['response'] = "Wrong number of release...";
                }
                break;
            }*/
            case "text": {
                switch($command) {
                    case "start": {
                        $sendmessage_options['response'] = "Nice to meet you";
                        break;
                    }
                    /*case "today_releases": {
                        for($i = 0; $i < count($releases); $i++) {
                            if($releases[$i]['date'] >= $today_date) {
                                if($sendmessage_options['response'] == NULL) {
                                    $sendmessage_options['response'] .= "/1 " . $releases[$i]['release'] . "";
                                } else {
                                    $sendmessage_options['response'] .= "\n" . "/" . strval($i+1) . " " . $releases[$i]['release'] . "";
                                }
                            }
                        }
                        break;
                    }
                    case "week_releases": {
                        for($i = 0; $i < count($releases); $i++) {
                            if($releases[$i]['date'] >= $current_weekstart_date) {
                                if($sendmessage_options['response'] == NULL) {
                                    $sendmessage_options['response'] .= "/1 " . $releases[$i]['release'] . "";
                                } else {
                                    $sendmessage_options['response'] .= "\n" . "/" . strval($i+1) . " " . $releases[$i]['release'] . "";
                                }
                            }
                        }
                        break;
                    }*/
                    default: {
                        $sendmessage_options['response'] = "Good function (no)." . "\n" . "Watch carefully...";
                    }
                }
                break;
            }
            case "badcommand": {
                $sendmessage_options['response'] = "Something goes wrong... Again...";
                break;
            }
            default: {
                $sendmessage_options['response'] = "Try again, please";
            }
        }
        return $sendmessage_options;
    }
}