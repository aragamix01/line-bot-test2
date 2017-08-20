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
        echo '<table border="1">';
            while ($obj = $result->fetch_object()) {
                echo '<tr>';
                    echo '<td>'.$obj->key.'</td><td>'.$obj->ans."</td>";
                    echo '<td><button>del</button></td>';
                echo '</tr>';
            }
        echo '</table>';
            $result->close();
    }

    $text = "ASD #? XCD";
    $text = explode("#?",$text);
    echo $text[0].' '.$text[1];
    
?>