<?php
include_once($_SERVER['DOCUMENT_ROOT']."/obsah.php");

function page_array(){
    require "conn.php";
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    $sql = "SELECT id, name FROM page";
    $r = $conn->query($sql);
    $result = array();
    $x = 0;
    while($row =$r->fetch_assoc() ){
        $result[$x]["id"] = $row["id"];
        $result[$x]["name"] = $row["name"];
        $x++;
    }
    $conn->close();
    return $result;
}

function getLastId($url){
    require($_SERVER['DOCUMENT_ROOT']."/conn.php");
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    $sql = "SELECT page_order FROM content WHERE page_id=(SELECT id FROM page WHERE url='$url')ORDER BY id DESC LIMIT 0, 1";
    return $conn->query($sql)->fetch_object()->page_order; 
  }

function getPageCount(){
    require($_SERVER['DOCUMENT_ROOT']."/conn.php");
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    return $conn->query("SELECT COUNT(*) AS total FROM page")->fetch_object()->total;
}


if (isset($_SESSION["login"])){
		if ($_SESSION["login"] == TRUE){ 
            require($_SERVER['DOCUMENT_ROOT']."/conn.php");
            $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
            $page_array = page_array();
            $sql = "SELECT * FROM page";
            $result = $conn->query($sql);
        
            while($row = $result->fetch_assoc()){
                echo "<form class='change-position'>";
                echo $row["name"];
                echo '<input type="hidden" name="id" value="'.$row["id"].'">';
                echo "<select name='position'>";
                for($i=1; $i<=getPageCount(); $i++){
                    echo "<option ".(($row["position"] == $i)?'selected="selected"':"").">".$i."</option>";
                }
                echo "<select>";
                echo "</form>";
              }
            

            
            ?>
            
            <form id="add-page">
                <input type="text" name="page_name" placeholder="Jmeno">
                <input type="text" name="page_url" placeholder="Adresa">
                <input type="submit" value="Přidat stránku">
            </form>
            <form id="add-content">
                <input type="text" name="page_heading" placeholder="Nadpis">
                <textarea type="text" name="page_text" placeholder="Obsah"></textarea>
                <?php
                echo "<select name='page_id'>";
                for($d = 0; $d < count($page_array); $d++){
                    echo '<option value="'.$page_array[$d]["id"].'">'.$page_array[$d]["name"]."</option>";                            
                }
                echo "</select>";
                ?>
                <input type="submit" value="Přidat stránku">
            </form>
            <script>
            $('#add-page, #add-content').submit(function(event){
                var ajaxRequest;
                event.preventDefault();
                ajaxRequest = $.ajax({
                    url: "engine/admin.php",
                    data: $(this).serialize(),
                    type: "post"
                })
                ajaxRequest.done(function(response){
                    if(response == "Succ"){
                        location.reload();
                    }
                    else{
                        console.log(response);
                    }
                }) 

            });
            $('.change-position').change(function(event){
                var ajaxRequest;
                event.preventDefault();
                console.log("asdasd");
                ajaxRequest = $.ajax({
                    url: "engine/admin.php",
                    data: $(this).serialize(),
                    type: "post"
                });
                ajaxRequest.done(function(response){
                    if(response == "Succ"){
                        location.reload();
                    }
                    console.log(response);

                });


            });
            

            </script>
            <?php   
        }
    }


if(isset($_POST["page_name"])){
    require($_SERVER['DOCUMENT_ROOT']."/conn.php");
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    $name = $_POST["page_name"];
    $url = $_POST["page_url"];
    $count = getPageCount()+1;
    $sql = "INSERT INTO page(name, url, position) VALUES ('$name', '$url',  $count)";
    if ($conn->query($sql) === TRUE) {
        echo "Succ";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
    
        
}if(isset($_POST["page_heading"])){
    require($_SERVER['DOCUMENT_ROOT']."/conn.php");
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    $name = $_POST["page_heading"];
    $url = $_POST["page_text"];
    $page_id = $_POST["page_id"];
    $last_id =  getLastId($conn->query("SELECT url FROM page WHERE id=$page_id")->fetch_object()->url)+1; 
    $sql = "INSERT INTO content(heading, text, page_id, page_order) VALUES ('$name', '$url', (SELECT id FROM page WHERE id=$page_id), $last_id)";
    if ($conn->query($sql) === TRUE) {
        echo "Succ";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
}
if(isset($_POST["position"])){
    require($_SERVER['DOCUMENT_ROOT']."/conn.php");
    $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
    $position = $_POST["position"];
    $id = $_POST["id"];
    $sql = "UPDATE page SET position='$position' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Succ";
    }
    else {
        echo "Error updating record: " . $conn->error;
    }
    
    $conn->close();
}
            ?>