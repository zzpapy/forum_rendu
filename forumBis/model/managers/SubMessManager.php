<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\SubMess;

    class SubmessManager extends Manager{

        protected $className = "Model\Entities\SubMess"; 
        protected $tableName = "Submess";

        public function __construct(){
            parent::connect();
        }

       
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
        public function findByMessage($id){
            // var_dump($this->tableName);die;
            $sql = "SELECT *
                    FROM ".$this->tableName." v WHERE v.message_id = :id
                    ORDER BY message_id DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }
        
    }