<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);


   $conn = new mysqli($server, $username, $password, $db);

    $key = $_POST["key"];
    $ans = $_POST["ans"];
    $sql = "INSERT INTO `heroku_da1dc32cdc85254`.`knowledge`(`key`,`ans`) VALUES ('$key','$ans')";
    
    if($conn->query($sql)){
        echo 'success';
        $qu = $conn->query("select * from heroku_da1dc32cdc85254.knowledge");
        $qu = mysqli_fetch_assoc($qu);
        foreach ($qu as $row){
            echo $row['ans'];
        }
    }else{
        echo 'failed';
    }
?>