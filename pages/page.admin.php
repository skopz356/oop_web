<?php 

    class Admin{
        public $handlers = array();
        public $url = "admin";

         function __construct(){
            $this->$handlers += array(
                'post/page_name' => function(){
                    echo "ahoj post";
    
                },
                'get/page_name' => function(){
                    echo "ahoj get";
                }
            );
        }
    }


    $page_array = array()


?>