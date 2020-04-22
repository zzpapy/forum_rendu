<?php
	namespace App;
	
	class Session{

     
      public static function sessionDestroy(){
            session_destroy();
      }
      public static function sessionAdmin(){
            return $_SESSION["admin"] = 1;
      }
      public static function addFlash($categ, $msg){
            $_SESSION[$categ] = $msg;
      }
      public static function addViews($id, $msg){
            $_SESSION["views"][$id] = $msg;
      }
      public static function getFlash($categ){
            if(isset($_SESSION[$categ])){
                $msg = $_SESSION[$categ];  
                unset($_SESSION[$categ]);
            }
            else $msg = "";            
            return $msg;
        }
      public static function verifUser(){
            $id = $_SESSION["user"]->getId();
            if(isset($id)){
                  return $id;
            }
            else{
                  return false;
            }
      }
 

	}
