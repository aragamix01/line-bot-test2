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

$messages2 = [
    0 => [
        'type' => 'text',
        'text' => $textt
    ],
    1 => [
        'type' => 'image',
        'originalContentUrl' => $imageUrl,
        'previewImageUrl' => $imageMiniUrl
    ]
];

echo 'Is a '.gettype($messages);
print_r($messages);
echo '<br>';
print_r($messages);
?>