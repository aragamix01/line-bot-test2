<?php
    include_once "./bot4fn.php";

    $conn = getConnection();

    $access_token = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';
    $imageUrl = 'https://still-beyond-73841.herokuapp.com/bnk48_3.jpg';
    $imageMiniUrl = 'https://still-beyond-73841.herokuapp.com/rsz_1bnk48_3.jpg';
    
    $content = file_get_contents('php://input');
    $events = json_decode($content, true);

    if (!is_null($events['events'])) {
        foreach ($events['events'] as $event) {
            if($event['type'] == 'message' && $event['message']['type'] == 'text' ){

                $replyToken = $event['replyToken'];
                $messages = [
                    'type' => 'text',
                    'text' => $text
                ];
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages],
                ];
                sendMessage($data,$access_token);
            }
        }
    }
        

    closeConnection($conn);
?>