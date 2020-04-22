<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Groupe;

    class GroupManager extends Manager{

        protected $className = "Model\Entities\Groupe"; 
        protected $tableName = "groupe";

        public function __construct(){
            parent::connect();
        }
 
        public function add($data){
            if(isset($data["nom"])){
                $data["nom"] = filter_var ( $data["nom"], FILTER_SANITIZE_STRING);
                // var_dump($data,$this->tableName);die;
                $keys = array_keys($data);
                $values = array_values($data);
                
                $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).")
                VALUES
                ('".implode("','",$values)."')";
                return DAO::insert($sql);
                   
            }
        }
        public function findMyGroups($id){
            $sql = " SELECT a.*
            FROM ".$this->tableName." a 
            WHERE membre_id=".$id;
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
            var_dump("toto");
        }
        
       
        
    }