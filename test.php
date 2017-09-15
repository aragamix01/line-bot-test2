<?php
$messages = [
    {
        'type' => 'text',
        'text' => $text
    },
    {
        // 'type' => 'image',
        // 'originalContentUrl' => $imageUrl,
        // 'previewImageUrl' => $imageMiniUrl
        'type' => 'text',
        'text' => $text
    }
]

echo 'Is a '.gettype($messages);
print_r($messages);
?>