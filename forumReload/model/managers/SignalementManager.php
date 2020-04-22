<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Topic;

    class SignalementManager extends Manager{

        protected $className = "Model\Entities\Signalement";
        protected $tableName = "signalement";

        public function __construct(){
            parent::connect();
        }

        public function signal(){
           
            $keys = array_keys($_POST);
            $values = array_values($_POST);
            $sql = "INSERT INTO ".$this->tableName."
            (".implode(',', $keys).")
            VALUES
            ('".implode("','",$values)."')";

            return DAO::insert($sql);

        }

        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE post_id= :id";
            // var_dump($id);die;
            return DAO::delete($sql,["id" => $id]);
        }
        

    }