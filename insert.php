<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: red;">
        <a class="navbar-brand pull-middle" href="#">Manage Bot Data</a>
    </nav>
    </body>
</html>
<?php 
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    
    
    $conn = new mysqli($server, $username, $password, $db);

  
    
    
    $sql_select = "select * from heroku_da1dc32cdc85254.knowledge";
    if ($result = $conn->query($sql_select)) {
        echo '<table class="table">';
        echo '<th><td>Delete</td><td>Keywords</td><td>Answers</td></th>';
            while ($obj = $result->fetch_object()) {
                echo '<tr>';
                    echo '<td><a href="delete.php?id='.$obj->knId.'" role="button" class="btn btn-danger">del</a></td>';
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