<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/obsah.php");
    function getDates($blok){
        require($_SERVER['DOCUMENT_ROOT']."/conn.php");
        $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
        $send;
        $page = getPageName();
        if($page == "home"){
            $page = "./";
        }
        $sql = "SELECT text FROM content WHERE (page_order=".$blok.") AND (page_id=(SELECT id FROM page WHERE url='".$page."' ))";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
            $send = $row["text"];
            }
        } 
        if(isset($send)){
            return '<div class="editable" value="'.$blok.'" >'.$send.'</div>';
        }else{
            return "Nenalezen žádný blok";
        }
    }
    
    function getHeading($blok){
        require($_SERVER['DOCUMENT_ROOT']."/conn.php");
        $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
        $send;
        $page = getPageName();
        if($page == "home"){
          $page = "./";
        }
        $sql = "SELECT heading FROM content WHERE (page_order=".$blok.") AND (page_id=(SELECT id FROM page WHERE url='".$page."' ))";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()){
            $send = $row["heading"];
          }
        }
        if(isset($send)){
            return '<div class="editable" value="'.$blok.'" >'.$send.'</div>';
        }else{
            return "Nenalezen žádný blok";
        }
      }
?>