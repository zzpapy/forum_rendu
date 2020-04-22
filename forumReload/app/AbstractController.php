<?php

    namespace App;

    abstract class AbstractController{

        protected static function redirectTo($ctrl = null, $action = null, $id = null){
            $url = "index.php";
            $url.= ($ctrl) ? "?ctrl=".$ctrl : "?ctrl=home";
            $url.= ($action) ? "&action=".$action : "";
            $url.= ($id) ? "&id=".$id : "";
            header("Location: $url");
            die();
        }

        protected static function restrictTo($page,$role){
            if(!Session::getUser()->hasRole($role)){
                self::redirectTo($page);
            }
        }
        

    }