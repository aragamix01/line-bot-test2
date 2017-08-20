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

  
    
    
    
    if ($result = $conn->query("select * from heroku_da1dc32cdc85254.knowledge")) {
        
            /* fetch object array */
            while ($obj = $result->fetch_object()) {
                printf ("%s (%s)\n", $obj->key, $obj->ans);
            }
        
            /* free result set */
            $result->close();
    }
    
?>