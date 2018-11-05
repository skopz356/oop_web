<?php
    require_once("abstract.php");
    require_once("login.php");
    class Image extends DatabaseMixin{
        private $url;

        function __construct(){
            parent::__construct();
        }

        public static function getImgName($index){
            $sql = "SELECT img FROM page";
            $result = self::$conn::query($sql);
            self::$conn->query($sql);
            

        }

        public static function removeImage($path){
            if(Login::isLogin()){
                unlink($path);
            }

        }
    }
?>