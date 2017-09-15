<?php
$messages = [
    [
        'type' => 'image',
        'originalContentUrl' => $imageUrl,
        'previewImageUrl' => $imageMiniUrl
    ],
    [
        'type' => 'image',
        'originalContentUrl' => $imageUrl,
        'previewImageUrl' => $imageMiniUrl
    ]
];

echo 'Is a '.gettype($messages);
print_r($messages);
?>