<?php
    $roomToken = 'C9ac0d8c426f5f88e9609cc2f5d8a23b8';
    $myToken = 'U44f0ae5516e30be72d074400a86ef343';
    $secret = 'd4f35b7ecb191edd8b6a48631d06780d';
    $cToken = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';
    // $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($cToken);
    // $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $secret]);

    // $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
    // $response = $bot->pushMessage($token, $textMessageBuilder);

    // echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

    $url = 'https://api.line.me/v2/bot/message/push';

    $messages = [
				'type' => 'text',
				'text' => "ทุกๆคนที่เข้ามาใหม่ครับ เมื่อเข้ามาแล้วให้ทำดังนี้นะครับ \n -แนะนำตัวเอง \n -ประทับใจอะไรใน bnk48"
	];

    $data = [
        'to' => $roomToken,
        'messages' => [$messages],
    ];
    $post = json_encode($data);
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $cToken);

    while(1){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result . "\r\n";
        sleep(200);
    }
?>