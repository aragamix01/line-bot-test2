<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);


if($conn = new mysqli($server, $username, $password, $db)){
    echo true;
}else{
    echo false;
}

$access_token = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';
$roomToken = 'C9ac0d8c426f5f88e9609cc2f5d8a23b8';
$imageUrl = 'https://still-beyond-73841.herokuapp.com/bnk48.jpg';
$imageMiniUrl = 'https://still-beyond-73841.herokuapp.com/bnk48_mini.jpg';

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {
    foreach ($events['events'] as $event) {
        if ( $event['type'] == 'message' && $event['message']['type'] == 'text' ){
            $msg_status = 0; //0 = normal_message,1 = train_message,2 = power_message,3 = return messages
            if(strpos($event['message']['text'],"#?") !== false ){
                $temp = $event['message']['text'];
                $temp = explode('#?',$temp);

                $key = $temp[0];
                $ans = $temp[1];
                $sql = "INSERT INTO `heroku_da1dc32cdc85254`.`knowledge`(`key`,`ans`) VALUES ('$key','$ans')";

                $conn->query($sql);

                $text = "ช้อนรู้แล้วว";
                $msg_status = 1;
            }else if( strcmp($event['message']['text'],"c_sleep") == false || strcmp($event['message']['text'],"c_wake") == false 
                        || strcmp($event['message']['text'],"รายชื่อ") == false ){
                    $c_status = 0;
                        if( strcmp($event['message']['text'],"c_sleep") == false ){
                            $c_status = 0;
                            $text = "ช้อนง่วงแล้วช้อนไปก่อนนะzZ";
                            $msg_status = 2;
                        }else if( strcmp( $event['message']['text'],"c_wake") == false ){
                            $c_status = 1;
                            $text = "ช้อนคนดีคนเดิมมาแล้วจ้าาา..";
                            $msg_status = 2;
                        }else{
                            $c_status = 1;
                            $msg_status = 3;
                        }

                        $sql_status = "UPDATE `heroku_da1dc32cdc85254`.`status` SET `sta` = $c_status WHERE `staId` = 1";
                        $conn->query($sql_status);

                
            }else{
                
                $sql_select = "select * from heroku_da1dc32cdc85254.knowledge";
                if ($result = $conn->query($sql_select)) {
                    
                        while ($obj = $result->fetch_object()) {
                            if( strpos($event['message']['text'],$obj->key) !== false ){
                                $text = $obj->ans;
                                break;
                            }
                        }
                    
                        $result->close();
                }
                //$text = $event['message']['text'];
            }

            $replyToken = $event['replyToken'];

            if($msg_status == 3){
                $messages = [
                    'type' => 'image',
                    'originalContentUrl' => $imageUrl,
                    'previewImageUrl' => $imageMiniUrl
                ];
            }else{
                $messages = [
                    'type' => 'text',
                    'text' => $text
                ];
            }

            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

            $sql_status = "SELECT * FROM `heroku_da1dc32cdc85254`.`status` WHERE staId = 1";
            if ($result = $conn->query($sql_status)) {
                
                    while ($obj = $result->fetch_object()) {
                        $check_status = $obj->sta;
                    }
                
                    $result->close();
            }

            if($check_status){
                $result = curl_exec($ch);
            }
            curl_close($ch);
            echo $result . "\r\n";
        }
    }
}
$conn->close();
echo "OK";
?>