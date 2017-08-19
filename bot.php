<?php
$access_token = '5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		$join = 0;
		if ($event['type'] == 'join'){
			$text = "ทุกๆคนที่เข้ามาใหม่ เมื่อเข้ามาแล้วให้ทำดังนี้นะคะ \n 1.) แนะนำตัวเอง \n 2.) ประทับใจอะไรใน bnk48 \n แล้วอดใจรอซักครู่นะคะ";
			$join = 1;
		}
		if ($event['type'] == 'message' && $event['message']['type'] == 'text' ) {
			// Get text sent
			
			
			$question = [
				0 => [
					'keywords' => 'สี',
					'ans' => 'สีเหลือง'
				],
				1 => [
					'keywords' => 'จังหวัด',
					'ans' => 'สิงค์บุรี'
				],
				2 => [
					'keywords' => 'พก',
					'ans' => 'ช้อน'
				],
				3 => [
					'keywords' => 'ทำผิด',
					'ans' => 'เค้าขอโทดดด'
				],
				4 => [
					'keywords' => 'ฉายา',
					'ans' => 'เชเช่,ดอรี่,เซ้นต์แจน'
				],
				5 => [
					'keywords' => 'เทศการ',
					'ans' => 'คริสมาสต์'
				],
				6 => [
					'keywords' => 'ช้อน',
					'ans' => 'จ๋าาา..'
				],
				7 => [
					'keywords' => 'สวย',
					'ans' => 'เชเช่'
				]
			];

			$found = 0;

			if($join == 0){
				foreach ( $question as $row ){
					if( strpos($event['message']['text'],$row['keywords']) !== false ){
						$text = $row['ans'];
						$found = 1;
						break;
					}
				}
			}

			

			if($found !== 0 || $join == 1){
				//$text = 'ช้อนไม่เข้าใจ ช้อน SO VERY กระจอก';
			

				//$text = $event['message']['text'];

					// Get replyToken
				$replyToken = $event['replyToken'];

				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
				];

				// Make a POST Request to Messaging API to reply to sender
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
				$result = curl_exec($ch);
				curl_close($ch);
				echo $result . "\r\n";

			}
		}
	}
	
}
echo "OK";
?>
