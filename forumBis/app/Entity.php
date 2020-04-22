<?php
    namespace App;

    abstract class Entity{
       

        protected function hydrate($data){
            $tab = [];
           
            foreach($data as $field => $value){
                $fieldArray = explode("_", $field);
                
                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                    $manName = ucfirst($fieldArray[0])."Manager";
                    $FQCName = "Model\\Managers\\".$manName;
                    
                    $man = new $FQCName();
                    $value = $man->findOneById($value);
                    
                }
                // var_dump($value);
                
                $method = "set".ucfirst($fieldArray[0]);
                if(method_exists($this, $method)){
                    array_push($tab, $this->$method($value));
                    $this->$method($value);
                    
                }
                
            }
           
        }

        public function getClass(){
            return get_class($this);
        }
    }