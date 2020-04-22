<?php
    namespace App;

    abstract class Manager{

        protected function connect(){
            DAO::connect();
        }

        public function findAll($order = null){

            $orderSQL = ($order != null) ?
                "ORDER BY a.".$order[0]. " " .$order[1] : "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ".$orderSQL;
            // var_dump($sql);die;
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
        public function findOneById($id){
            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }


        public function add($data){
            $keys = array_keys($data);
            $values = array_values($data);
            $sql = "INSERT INTO ".$this->tableName."
                    (".implode(',', $keys).")
                    VALUES
                    ('".implode("','",$values)."')";
            try{
                return DAO::insert($sql);
            }
            catch(\PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        
        public function delete($id){
            $sql = "DELETE
                    FROM ".$this->tableName." u
                    WHERE a.id_".$this->tableName." = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::delete($sql, ['id' => $id], false), 
                $this->className
            );
        }
        public function isAuthor($id){
            // var_dump($id);die;
            $sql = "SELECT user_id FROM ".$this->tableName." WHERE user_id= :id";
            return DAO::selectCol($sql,["id"=>$id],"user_id");
        }
        
        protected function getMultipleResults($rows, $class){

            $objects = [];
            // var_dump($class);die;
            if(!empty($rows)){
                foreach($rows as $row){
                    $objects[] = new $class($row);
                }
            }
            
            return $objects;
        }

        protected function getOneOrNullResult($row, $class){

            if($row != null){
                return new $class($row);
            }
            return false;
        }

        protected function getSingleScalarResult($row){

            if($row != null){
                $value = array_values($row);
                return $value[0];
            }
            return false;
        }
    
    }