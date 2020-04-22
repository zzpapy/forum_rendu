<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Topic;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }
        public function closeTopic($id,$closed){
            // var_dump($closed);die;
            $sql = "UPDATE ".$this->tableName."
            SET closed = ".$closed."
            WHERE id_topic= :id";
            return DAO::update($sql,["id"=>$id]);

        }
        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE id_topic = :id";
            // var_dump($id);die;
            return DAO::delete($sql,["id" => $id]);
        }

        

    }