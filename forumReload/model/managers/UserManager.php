<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Entities\User;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";

        public function __construct(){
            parent::connect();
        }

        public function checkUserExists($email){
            $sql = "SELECT COUNT(u.id_user)
                    FROM ".$this->tableName." u
                    WHERE u.email = :email
                    ";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['email' => $email], false)
            );
        }

        public function retrievePassword($email){
            $sql = "SELECT u.password
                    FROM ".$this->tableName." u
                    WHERE u.email = :email
                    ";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['email' => $email], false)
            );
        }
        public function connection($id,$connect){
        //    var_dump($connect,$id);die;
            $sql = "UPDATE ".$this->tableName."
            SET connected = '".$connect."'
            WHERE id_user= :id";
            return DAO::update($sql,["id"=>$id]);

        }

        public function modifAvatar($id,$avatar){
            //    var_dump($connect,$id);die;
            // var_dump($_POST,$_FILES);die;
                $sql = "UPDATE ".$this->tableName."
                SET avatar = '".$avatar."'
                WHERE id_user= :id";
                return DAO::update($sql,["id"=>$id]);
    
            }
        public function modifUsername($id,$username){
            //    var_dump($connect,$id);die;
            // var_dump($_POST,$_FILES);die;
                $sql = "UPDATE ".$this->tableName."
                SET username = '".$username."'
                WHERE id_user= :id";
                return DAO::update($sql,["id"=>$id]);
    
            }

        public function findByEmail($email){

            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    WHERE u.email = :email
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }

    }