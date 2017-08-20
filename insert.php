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
                    echo '<td><a href="delete.php?id='.$obj->knId.'" >del</a></td>';
                    echo '<td>'.$obj->key.'</td><td>'.$obj->ans."</td>";
                echo '</tr>';
            }
        echo '</table>';
        $result->close();
    }

    $sql = "SELECT * FROM `heroku_da1dc32cdc85254`.`status` WHERE staId = 1";
    if ($result = $conn->query($sql)) {
        
            while ($obj = $result->fetch_object()) {
                echo $obj->sta;
            }
        
            $result->close();
    }
    
?>