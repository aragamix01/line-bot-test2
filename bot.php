<?php
$access_token = '	5fUwVGVAEzh0STff4waRo1361kbdfS306CJ+pVaO9+T7dXfrSLum6m0nAWpDx3hOKBVKPiebT7tVDcwT3MPSZYKiKYX0M2RSAgpDu2pFnjHw4YziX8CTgyyqZcgT39OjtOc+OatIxAfp/J+d/YTNRQdB04t89/1O/w1cDnyilFU=';

// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';

            $messages = [
				'type' => 'text',
				'text' => "Test"
			];

			$data = [
				'replyToken' => $replyToken,
				'messages' => "[$messages]",
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
?>
