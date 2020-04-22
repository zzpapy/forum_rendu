<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\Membre;

    class SignalementManager extends Manager{

        protected $className = "Model\Entities\Signalement"; 
        protected $tableName = "signalement";

        public function __construct(){
            parent::connect();
        }

       
        
        public function findOneById($id){
            return parent::findOneById($id);
        }
       
    }