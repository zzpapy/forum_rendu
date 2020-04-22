<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Membre;

    class MembreManager extends Manager{

        protected $className = "Model\Entities\Membre"; 
        protected $tableName = "membre";

        public function __construct(){
            parent::connect();
        }

       
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
        public function deleteUser($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE id_membre=".$id;
            // var_dump($this->tableName);die;
            return $this->getMultipleResults(
                DAO::delete($sql), 
                $this->className
            );
        }
        public function findPhoto(){
            $tab= [];
            $sql = "SELECT m.photo
            FROM message m
            WHERE m.photo IS NOT NULL";
            $photo_mess =  DAO::select($sql);
            if(count($photo_mess) > 1){
                foreach ($photo_mess as $key => $value) {
                    array_push($tab,$value);
                    
                }
            }
            else{
                array_push($tab,$photo_mess);
            }
            $sql = "SELECT s.photo
            FROM sujet s
            WHERE s.photo IS NOT NULL";
            $photo_sujet =  DAO::select($sql);
            if(count($photo_sujet) > 1){
                foreach ($photo_sujet as $key => $value) {
                    array_push($tab,$value);
                    
                }
            }
            else{
                array_push($tab,$photo_sujet);
            }
            
            return $tab;
        }
        public function selectUsers(){
            $sql = "SELECT m.id_membre, m.pseudo, m.connected FROM ".$this->tableName." m";
            // var_dump($this->tableName);die;
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        public function updateConnect($id){
            // var_dump($_POST);die;
            $sql = "UPDATE ".$this->tableName."
            SET connected = '1'
            WHERE id_membre=".$id;
            return DAO::update($sql);
        }
        public function updateUnConnect($id){
            // var_dump($_POST);die;
            $sql = "UPDATE ".$this->tableName."
            SET connected = '0'
            WHERE id_membre=".$id;
            return DAO::update($sql);
        }
        public function findConnected(){
            $sql = "SELECT m.id_membre, m.connected FROM ".$this->tableName." m
            WHERE connected=1";
            // var_dump($sql);die;
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
       
    }