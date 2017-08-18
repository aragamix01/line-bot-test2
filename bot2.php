<?php
    $token = 'C9ac0d8c426f5f88e9609cc2f5d8a23b8';
    $secret = 'd4f35b7ecb191edd8b6a48631d06780d';
    $cToken = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';
    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($cToken);
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);

    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
    $response = $bot->pushMessage($token, $textMessageBuilder);

    echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>