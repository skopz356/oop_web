<?php

    session_start();

    if(isset($_POST["username"]) && isset($_POST["password"])){    
        if ($_POST["username"] == "admin" && $_POST["password"] == "tomjepan123"){
            $_SESSION["login"] = TRUE;
            echo "Succ";
        }
        else{
            echo "Bad";
        }
        
    }

?>