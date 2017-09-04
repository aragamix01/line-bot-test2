<?php
    function getConnection(){
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        
        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);
        
        
        if($conn = new mysqli($server, $username, $password, $db)){
            echo true;
        }else{
            echo false;
        }
        return $conn;
    }

    function closeConnection($conn){
        $conn->close();
    }
?>