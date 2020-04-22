<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Post;

    class CommentManager extends Manager{

        protected $className = "Model\Entities\Comment";
        protected $tableName = "comment";

        public function __construct(){
            parent::connect();
        }

        public function findByPost($id,$order = null){

            $orderSQL = ($order != null) ?
                "ORDER BY a.".$order[0]. " " .$order[1] : "";

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    WHERE post_id= :id".$orderSQL;
            // var_dump($sql);die;
            return $this->getMultipleResults(
                DAO::select($sql,["id"=>$id]), 
                $this->className
            );
        }
        
    }