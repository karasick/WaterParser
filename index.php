<?php
include 'WebServer/Page.php';
use WebServer\Page;

Page::TopHead("WaterParserBot");

#echo "<center>" . "<h1>" . "All go wrong..." . "</h1>" . "</center>";
echo "<center>" . "<h1>" . "Something goes right." . "</h1>" . "</center>";

ini_set('error_reporting', E_ALL);

/*include 'Parser/cURL/cURLOptions.php';
include 'Parser/Database/Including.php';
include 'Parser/Database/Functions.php';
include 'Parser/Exceptions/cURLExceptions.php';
include 'Parser/ParserAPI.php';
include 'Parser/simple_html_dom.php';
use \Parser\Database\Functions;
use \Parser\Database\Including;
use \Parser\ParserAPI;*/
include_once 'TelegramServer/Methods/SendContent.php';
include_once 'TelegramServer/Methods/ScanContent.php';
include_once 'TelegramServer/Methods/SetOptionsFrom.php';
include_once 'TelegramServer/Updating/Chat.php';
use \TelegramServer\Methods\ScanContent;
use \TelegramServer\Methods\SendContent;
use \TelegramServer\Methods\SetOptionsFrom;
use \TelegramServer\Updating\Chat;

$Token = "578065863:AAGAWk-RJO3GcB88J0gFBLIeA8Vizj4lQyk";
$website = "https://api.telegram.org/bot" . $Token;
/*$parsed_link = Including::GetLink();
$releases = Functions::GetReleases($parsed_link);
$current_date = intval(date("ymdHi"));
if($current_date > (intval($releases[0]['date']) + 100)) {
    ParserAPI::ParseNew($parsed_link);
    $releases = Functions::GetReleases($parsed_link);
}*/

/* GetUpdates or Webhook methods */
$updatedArray = Chat::WebUpdate();
$chatId = Chat::GetWebChatId($updatedArray);
$text = Chat::GetWebText($updatedArray);

#$updatedArray = Chat::GetUpdate($website);
#$chatId = Chat::GetUpdChatId($updatedArray);
#$text = Chat::GetUpdText($updatedArray);

$sendmessage_options = array('website' => $website, 'chatId' => $chatId, 'response' => NULL, 'keyboard' => NULL);
$message = ScanContent::Message($text);
$message_type = ScanContent::MessageType($message);
switch($message_type) {
    case "command": {
        $command = $message[1];
        $command_type = ScanContent::CommandType($command);
        $sendmessage_options = SetOptionsFrom::Command($sendmessage_options, $command, $command_type, $releases);
        break;
    }
    case "message": {
        $text_responses = array(0 => "Yes ?", "Here I come", "How ?", "You are nice)", "Nya", "You laught - you lose!", "*ugly barking*");
        $sendmessage_options['response'] = $text_responses[rand(0, 6)];
        break;
    }
    case "badmessage": {
        $sendmessage_options['response'] = "Something goes wrong...";
        break;
    }
    default: {
        $sendmessage_options['response'] = "Try again";
    }
}
SendContent::SendMessage($sendmessage_options);

Page::Bottom();
?>