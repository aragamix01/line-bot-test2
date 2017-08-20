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
    
    
    $conn = new mysqli($server, $username, $password, $db);

  
    
    
    $sql_select = "select * from heroku_da1dc32cdc85254.knowledge";
    if ($result = $conn->query($sql_select)) {
        
            while ($obj = $result->fetch_object()) {
                echo $obj->key."<br>".$obj->ans;
            }
        
            /* free result set */
            $result->close();
    }
    
?>