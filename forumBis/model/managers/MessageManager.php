<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use App\Session;
    use Model\Entities\User;

    class MessageManager extends Manager{

        protected $className = "Model\Entities\Message"; 
        protected $tableName = "message";

        public function __construct(){
            parent::connect();
        }

       
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
        public function countMess(){
            // var_dump($this->tableName);die;
            $sql = "SELECT sujet_id, count(id_message) AS nb
                    FROM ".$this->tableName." a
                    GROUP BY sujet_id";
                    // var_dump($this->tableName);die;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        public function findAll(){

            $sql = "SELECT *
                    FROM ".$this->tableName." a
                    ORDER BY date DESC";
                    // var_dump($sql);die;
       
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        public function delete($id){
            // var_dump($this->tableName);die;
            $sql = "DELETE FROM ".$this->tableName." WHERE id_message=".$id;
            return $this->getMultipleResults(
                DAO::delete($sql), 
                $this->className
            );
        }
        public function messNb($sujet){
// var_dump($this->tableName);
            $sql = "SELECT COUNT(a.id_message) AS nb, sujet_id
                    FROM ".$this->tableName." a
                   WHERE a.sujet_id =".$sujet;
            
            // var_dump($id);
            return DAO::select($sql);
       
            // return $this->getMultipleResults(
            //     DAO::select($sql,["sujet"=>$sujet], false),
            //     $this->className
                
            // );
            
        }
        public function updateMess(){
            $filtre = filter_var ( $_POST["content"], FILTER_SANITIZE_STRING);
            if($filtre !=  $_POST["content"]){
                $msg = "c'est pas bien d'essayer de forcer";
                Session::addFlash("error",$msg);
                header("location: index.php?ctrl=home&action=index");die();
                // return [
                //     "view" => VIEW_DIR."sujet.php",
                //     "data" =>""
                // ];
            }
            else{
                $sql = "UPDATE ".$this->tableName."
                SET content = '".$_POST["content"]."'
                WHERE id_message=".$_POST["id_message"];
                return DAO::update($sql);
            }
        }
        public function findByUserId($membre_id){
            // var_dump($this->tableName);die;
            $sql = "SELECT *
                    FROM ".$this->tableName." v WHERE v.membre_id = :membre_id
                    ORDER BY date DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ['membre_id' => $membre_id]), 
                $this->className
            );
        } 
        public function modif($id){
            $man = new MessageManager();
            $test = $man->findOneById($id);
            $content = $test->getContent();
            // var_dump($_GET);die;
            return [
                "view" => VIEW_DIR."modif.php",
                "data" => [
                    "mess" => $test,
                    "content" => $content,
                    "sujet_id" => $_GET["sujet_id"]
                ]
            ];
        }
               
       
    }