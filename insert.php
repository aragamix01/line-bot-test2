<form action="testConnection.php" method="POST">
    <input type="text" name="key">
    <input type="text" name="ans">
    <input type="submit" name="submit" value="submit">
</form>
<?php 
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    
    //$conn = new mysqli($server, $username, $password, $db);
    $conn = mysql_connect($server,$username,$password);

    if (!$conn) {
        echo "Unable to connect to DB: " . mysql_error();
        exit;
    }
    
    if (!mysql_select_db($db)) {
        echo "Unable to select mydbname: " . mysql_error();
        exit;
    }
    
    // $qu = $conn->query("select * from heroku_da1dc32cdc85254.knowledge");
    // print_r($qu);
    // echo gettype($qu);
    
?>