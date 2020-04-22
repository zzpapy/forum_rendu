<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Appartient;

    class AppartientManager extends Manager{

        protected $className = "Model\Entities\Appartient"; 
        protected $tableName = "appartient";

        public function __construct(){
            parent::connect();
        }

        public function add($data){
            // var_dump($data);die;
                $keys = array_keys($data);
                $values = array_values($data);
                
                $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).")
                VALUES
                ('".implode("','",$values)."')";
                return DAO::insert($sql);
        }
        public function findGroupeMembre($id){
            // var_dump($this->tableName);die;
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.groupe_id = :id
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
        public function findGroupeParticipe($id){
            // var_dump($this->tableName);die;
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.membre_id = :id
            ORDER BY groupe_id DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
        
       
        
    }