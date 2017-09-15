<?php
    include_once "./bot4fn.php";

    $conn = getConnection();

    $access_token = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';

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
                // }else if(strcmp($event['message']['text'],"รายชื่อ") == false){
                    // $question = [
                    //     0 => [
                    //         'keywords' => 'สี',
                    //         'ans' => 'สีเหลือง'
                    //     ],
                    //     1 => [
                    //         'keywords' => 'สี',
                    //         'ans' => 'สีเหลือง'
                    //     ]
                    // ];

                //     $data = setData(0,$event['replyToken']);
                //     sendMessage($data,$access_token);
                // }
                else{
                    $isPics = 0;
                    $pickey = [
                        0 => [
                            'keywords' => 'บ้านปัญ',
                            'exText' => 'บ้านปัญไปตาม QR CODE นี้น้าา',
                            'picsName' => 'https://still-beyond-73841.herokuapp.com/pun_room.jpg'
                        ],
                        1 => [
                            'keywords' => 'บ้านรินะ',
                            'exText' => 'บ้านรินะไปตาม QR CODE นี้น้าา',
                            'picsName' => 'https://still-beyond-73841.herokuapp.com/rina_room.jpg'
                        ],
                        2 => [
                            'keywords' => 'รายชื่อ',
                            'exText' => 'รายชื่อด้อมที่ร่วมกับ GATE ทั้งหมด',
                            'picsName' => 'https://still-beyond-73841.herokuapp.com/bnk48_3.jpg'
                        ]
                    ];

                    foreach($pickey as $obj) {
                        if( strpos($event['message']['text'],$obj['keywords']) !== false ){
                            $isPics = 1;
                            $text = $obj['exText'];
                            $pics = $obj['picsName'];
                        }
                    }

                    if($isPics == 1){
                        $data = setData(0,$event['replyToken'],$text,$pics);
                        sendMessage($data,$access_token);
                    } else{
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
                        $data = setData(1,$event['replyToken'],$text);
                        sendMessage($data,$access_token);
                    }
                }
            }
        }
    }
        

    closeConnection($conn);
?>