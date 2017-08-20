<?php
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    
    $conn = new mysqli($server, $username, $password, $db);

    $knId = $_GET['id'];

    $sql = "DELETE FROM `heroku_da1dc32cdc85254`.`knowledge` WHERE knId = $knId";
    $conn->query($sql);

    header('Location: '."insert.php");
?>