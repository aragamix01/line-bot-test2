<?php
$messages = array(
    'replyToken' => $replyToken,
    'messages' => array(
        array(
            'type' => 'text',
            'text' => $text
        ),
        array(
            'type' => 'text',
            'text' => $text
        )
    )
);

echo 'Is a '.gettype($messages);
print_r($messages);
?>