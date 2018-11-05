<?php
use Pecee\SimpleRouter\SimpleRouter;
require_once("vendor/autoload.php");
require_once "login.php";



Class Route{
    private $conn;
    private $router;
    private  const tem_file = "templates/template.";

    function __construct(){
        require($_SERVER['DOCUMENT_ROOT']."/conn.php");
        $this->conn = new mysqli($server, $user, $password, $db_name) or die("Connect failed: %s\n". $conn -> error);     
        
    }
    
    public function renderView(){
        $sql = "SELECT url FROM page";
        $result = $this->conn->query($sql);
        $required = FALSE;
        while($row = $result->fetch_assoc()){
            SimpleRouter::get($row['url'], function() use ($row) {
                $this->renderPage($this->getTemplateName($row["url"]));
            });
        }
        SimpleRouter::get('/', function() {
            $this->renderPage($this->getTemplateName('./'));
        });
        SimpleRouter::get('admin', function() {
            $this->renderPage($this->getTemplateName('admin'));
        });
        SimpleRouter::get('odhlasit', function() {
            Login::logout();
        });
        SimpleRouter::error(function() {
            $this->renderPage($this->getTemplateName('not_found'));
        });
        SimpleRouter::start();
    }

    private function getTemplateName($url){
        if(file_exists(self::tem_file.$url.".php")){
            return self::tem_file.$url.".php";
        }elseif ($url === "./") {
            return self::tem_file."index.php";
        }elseif ($url === "admin"){
            return self::tem_file."admin.php";
        }
        else{
            return self::tem_file."base_view.php";
        }  
    }
    
    
    public function getPageName(){
        $backslash = strripos("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]","/");
        $ret = substr(str_replace("-","_","http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"), $backslash+1 );
        if (($ret == "")){
          $ret = "home";
        }
        if($ret == "o-mne"){
          $ret = "o_mne";
        }
        return $ret;
    }

    public static function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }


    private function renderPage($template){
        /**
         * @param string $template
         * @param boolean $menu
         * 
         * 
         */
        include_once($_SERVER['DOCUMENT_ROOT']."/obsah.php");
        echo "<!DOCTYPE html>";
        echo $head;
        echo "<body>"."\xA";
        
        if($template != self::tem_file."index.php"){
            render_menu();
        }
        if($template === self::tem_file."admin.php"){ 
            if(Login::isLogin()){
                require("engine/admin.php");
            }else{
                echo $admin_form;
            }
            require(self::tem_file."admin.php"); 
        }else{
            try{
                require $template;
            }catch(Exception $e){
                echo "File does not exist".$e->getMessage();
            } 
        }
        echo $footer;
        if(Login::isLogin()){
            require_once("engine/textedit.php");
        }
        echo "</body>"."\xA";
        echo "</html>"."\xA";
        
    }  
}
?>
