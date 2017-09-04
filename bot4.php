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
                if(strpos($event['message']['text'],"#?") !== false ){
                    $temp = $event['message']['text'];
                    $temp = explode('#?',$temp);
    
                    $key = $temp[0];
                    $ans = $temp[1];
                    $sql = "INSERT INTO `heroku_da1dc32cdc85254`.`knowledge`(`key`,`ans`) VALUES ('$key','$ans')";
    
                    $conn->query($sql);
                    $text = 'ช้อนรู้แล้ว ช้อนไม่ได้แก่แบบเช่นะที่จะจำไม่ได้อ่ะ';
                    $data = setData(1,$event['replyToken'],$text);
                    sendMessage($data,$access_token);
                }
            }
        }
    }
        

    closeConnection($conn);
?>