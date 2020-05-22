<?php



require "vendor/autoload.php";

$access_token = 'abj1xGuzs7uo3ilOaxa/l556ogSeln0XoGWstOxXSqxpdOlkU5iMeJCs3yI351g6XD+4qeVKZWgHVnwS5StSxE+qZjjIR6GrZBjuB3O/34FaGC4eHqryKH48E3H9G7+v8j3A+tXNhv6W1aSpJEZUpgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '3db92b35c8799fe15d3d7912b715ebc0';

$pushID = 'U2e3903a1a4ea6c7840c2cfa2e35d0eb1';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







