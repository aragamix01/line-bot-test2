<?php
$messages = [
    [
        'type' => 'text',
        'text' => $text
    ],
    [
        // 'type' => 'image',
        // 'originalContentUrl' => $imageUrl,
        // 'previewImageUrl' => $imageMiniUrl
        'type' => 'text',
        'text' => $text
    ]
];

$messages2 = array(
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
echo '<br>';
print_r($messages2);
?>