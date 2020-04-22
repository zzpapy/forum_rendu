<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Post;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        public function __construct(){
            parent::connect();
        }

        public function findByTopic($id,$order = null){

            $orderSQL = ($order != null) ?
                "ORDER BY a.".$order[0]. " " .$order[1] : "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE topic_id= :id".$orderSQL;
            // var_dump($sql);die;
            return $this->getMultipleResults(
                DAO::select($sql,["id"=>$id]), 
                $this->className
            );
        }

        public function delete($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE id_post= :id";
            // var_dump($id);die;
            return DAO::delete($sql,["id" => $id]);
        }
       
        public function modif($id){
            $filtre = filter_var ( $_POST["content"], FILTER_SANITIZE_STRING);
            $sql = "UPDATE ".$this->tableName."
            SET content = '".$filtre."'
            WHERE id_post= :id";
            return DAO::update($sql,["id"=>$id]);

        }
       

    }