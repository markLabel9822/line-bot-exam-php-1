<?php



require "vendor/autoload.php";

$access_token = 'rDQCJiR/ODdFOlA5JMKP6nLWZWI4FWE/p6G2rugsbdj2+KYSmADZyMNnMa4auy7NQ5gWJBYUrKUUyBw/hhh3iZ2+y8Rt08/MHKbWTAlAiP6eXZfGCa9jaDP39DmrhMG4XK8iDNvm6FrEpbJFlNU6FgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '2cb0b6972c64618e67db358e59bbab03';

$pushID = 'Ud2f9a8bbdd6e167dff9923cf2e718a73';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('1');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . 'WTF' . $response->getRawBody();







