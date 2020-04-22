<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Sujet;

    class SujetManager extends Manager{

        protected $className = "Model\Entities\Sujet"; 
        protected $tableName = "sujet";

        public function __construct(){
            parent::connect();
        }

       
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
        public function deleteSujet($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE id_sujet=".$id;
            // var_dump($this->tableName);die;
            return $this->getMultipleResults(
                DAO::delete($sql), 
                $this->className
            );
        }
        public function close($id){
            $sql = "UPDATE ".$this->tableName."
            SET close = 1
            WHERE id_sujet=".$id;
            // var_dump($id);die;
            return DAO::update($sql);
        }
        public function findAll(){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE groupe_id IS NULL
                    ORDER BY date DESC";
            // var_dump($sql);die;
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        
        public function findGroupeSujet($id){
            // var_dump($id);die;
            $sql = "SELECT *
            FROM ".$this->tableName." a
            WHERE a.groupe_id = :id
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }
    }