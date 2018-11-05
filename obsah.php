<?php 
$head = '
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="author" content="Tomáš Kubát">
<meta name="description" content="Zabývám se elektromontážemi, elektrickým vztápěním, montážemi hromosvodů">
<meta name="keywords" content="elektrikar, vrchlabi, oprava spotrebicu, hromosvody, Vrchlabí">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Elektro Kubát</title>
<script src="https://www.google.com/recaptcha/api.js"></script>
<link rel="stylesheet" href="/static/styles/src/bootstrap.min.css">
<link rel="stylesheet" href="/static/styles/src/style.css">
<link rel="stylesheet" href="/static/styles/src/animate.css">
<link rel="stylesheet" href="/static/styles/src/lightgallery.css">

<script src="/static/js/jquery.js"></script>
<script src="/static/js/script.js" defer></script>
<script src="/static/js/lightgallery.js" type="module"></script>
<script src="/static/js/thumbnail.min.js" type="module"></script>
<script src="/static/js/jquery.waypoints.min.js" type="module"></script>

<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
</head>';

$button = '<button id="toTop" title="Go to top"><img src="/images/icons/h.svg" id="buttonTop"></button>';

$footer = '<footer>Copyright © &nbsp;'.date("Y").'&nbsp; <a href="http://'.$_SERVER["HTTP_HOST"].'">jakubdurtdesing</a></footer>';


function render_menu(){
  require "conn.php";
  $conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);
  $sql = "SELECT name, url FROM page ORDER BY position ASC ";
  $result = $conn->query($sql);
    echo "<header>"."\xA";
      echo "<nav>"."\xA";
        echo '<button class="hamburger">Menu</button>'."\xA";
        echo '<a href="./" class="logo"><div class="logo-img"></div></a>'."\xA";
        echo '<ul id="menu">'."\xA";
        while($row = $result->fetch_assoc()){
            $x = getPageName();
            if($x == "home"){
              $x = "./";
            }
            $d = $row["url"];
            if($d != "./"){
                $d = "/".$d;
            }
            echo '<li><a href="'.$d.'"'.(($row["url"] == $x)?' class="selected"':"").'>'.$row["name"].'</a></li>'."\xA";
            
          }
        echo "</ul>"."\xA";
    echo "</nav>"."\xA";
echo "</header>"."\xA";
    $conn->close();
  
  }

function getPageName(){
  $backslash = strripos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]","/");
  $ret = substr(str_replace("-","_","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"), $backslash+1 );
  if (($ret == "") || ($ret == "admin")){
    $ret = "home";
  }
  if($ret == "o-mne"){
    $ret = "o_mne";
  }
  return $ret;
}

$admin_form = '<div class="overlay"><form id="login-form" method="post">
              <div>
              <label for="username">Jmeno:</label><input type="text" value="" id="username" name="username" required="" /></div>
              <div><label for="password">Heslo:</label><input type="password" value="" id="password" name="password" required=""/></div>
              <div class="error">Neco spatne</div>
              <input type="submit" value="Odeslat" name="sub" />
              </form></div>';


?>
