<?php
$messages = [
    'msg1' => [
        'type' => 'image',
        'originalContentUrl' => $imageUrl,
        'previewImageUrl' => $imageMiniUrl
    ],
    'msg2' => [
        'type' => 'image',
        'originalContentUrl' => $imageUrl,
        'previewImageUrl' => $imageMiniUrl
    ]
];

echo 'Is a '.gettype($messages);
print_r($messages);
?>