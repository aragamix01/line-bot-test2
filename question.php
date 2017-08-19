<?php
    $question = [
        0 => [
            'keywords' => 'สี',
            'ans' => 'สีเหลือง'
        ],
        1 => [
            'keywords' => 'สี',
            'ans' => 'สีเหลือง'
        ]
    ];

    echo $question;

    foreach($question as $row){
         echo $row['ans'];
    }
?>