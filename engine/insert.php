<?php 
    if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    if ($_SESSION["login"] === TRUE){
        require($_SERVER['DOCUMENT_ROOT']."/conn.php");
        $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
        $page = $_POST["page"];
        if($page == "home"){
            $page = "./";
        }
        $sql = "UPDATE content SET ".$_POST["type"]."="."'".$_POST["editarea"]."'"." WHERE (page_order=".$_POST["id"].") AND (page_id=(SELECT id FROM page WHERE url='$page'))";
        if ($conn->query($sql) === TRUE) {
            echo "Succ";
        } else {
            echo "Error updating record: " . $conn->error;
            echo $sql;
        }
       
        

        

    }




?>