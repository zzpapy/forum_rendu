<?php
    namespace Controller;

    use Model\Managers\MembreManager;
    use Model\Managers\SujetManager;
    use Model\Managers\MessageManager;
    use APP\Session;
    
    
    class SecurityController{

        public function index(){
           

            return [
                "view" =>  VIEW_DIR."sujet.php"];
        }
       

       
        public function signIn(){

            return [
                "view" =>  VIEW_DIR."crea-compte.php"
            ];
        }
        public function crea($data){
            $man = new MembreManager($_POST);
            $user = $man -> findOneByName($data["pseudo"]);
            if($user){
                echo "le pseudo est déjà utilisé";
                return [
                    "view" => VIEW_DIR."crea-compte.php",
                    "data" => ""
                ];
            }
            else{
                $user  = $man -> add($_POST);
                return [
                    "view" => VIEW_DIR."sujet.php",
                    "data" => ""
                ];
            }
        }
        public function connect(){
            $man = new MembreManager();
            // $user = $man -> findOneByName($_POST["pseudo"]);
            $user = $man -> findOneByNameBis($_POST["pseudo"],"id_membre");
            $bool = false;
            if($user){
                $pass = $man -> findOneByNameBis($_POST["pseudo"],"password");
                $pseudo = $man -> findOneByNameBis($_POST["pseudo"],"pseudo");
                if( password_verify($_POST["password"], $pass) && $_POST["pseudo"] == $pseudo){
                    $user = $man->findOneByIdUser($user);
                    $bool = true;
                    if($user->getPseudo() == "zzpapy"){
                            Session::addFlash("admin",1);
                        }
                        
                        
                        $man = new SujetManager();
                        $sujets = $man->findAll(); 
                        $action = "crea_sujet"; 
                        if(is_object($sujets)){
                            $man = new MessageManager();
                            $mess = $man->findBySujet($sujets->getId());
                            if($mess && !is_object($mess)){
                                $tab[$sujets->getId()] = count($mess);
                            }
                            else if(is_object($mess)){
                                $tab[$sujets->getId()] = 1;
                            }
                            else{
                                $tab[$sujets->getId()] = 0;
                            }
                            
                        }
                        else{                            
                            foreach ($sujets as $key => $value) {
                                $man = new MessageManager();
                                $mess = $man->findBySujet($value->getId()); 
                                if($mess && !is_object($mess)){
                                    $tab[$value->getId()] = count($mess);
                                }
                                else if(is_object($mess)){
                                    $tab[$value->getId()] = 1;
                                }
                                else{
                                    $tab[$value->getId()] = 0;
                                }
                            }
                        }
                        $test = new MembreManager();
                        $connect = $test->updateConnect($user->getId());
                        $connected = $test->findConnected();
                        $test = $test->selectUsers();
                        // var_dump($connected);die;
                        // var_dump($test);
                        $msg = "Vous êtes maintenant connecté";
                        Session::addFlash("success",$msg);
                        Session::addFlash( "connected",$connected);
                        Session::addFlash( "bool",$bool);
                        Session::addFlash( "user",$user);
                        
                    // var_dump($_SESSION["user"]);die;
                        Session::addFlash( "liste",$sujets);
                        Session::addFlash( "mess",$tab);
                        Session::addFlash( "users",$test);
                        Session::addFlash( "connect",true);
                        Session::addFlash( "debut",time());
                            
                        header('location:index.php?ctrl=home&action=sujet');die();
                        }                   
                        else{
                            $msg = "Une erreur s'est produite merci de vérifier vos éléments de connexion";
                            Session::addFlash("error",$msg);
                            
                            return [
                                "view" => VIEW_DIR."sujet.php" ,
                                "data" => "ce compte n'existe pas"                       
                            ];
                        }
                    }
                    else{
                        $msg = "Une erreur s'est produite merci de vérifier vos éléments de connexion";
                        Session::addFlash("error",$msg);
                        return [
                            "view" => VIEW_DIR."sujet.php" ,
                            "data" => "le mot de passe ou le pseudo est incorrect !!!"                       
                        ];
            }   
        }
        public function logout(){
            $test = new MembreManager();
            if(isset($_SESSION["user"])){
                $connect = $test->updateUnConnect($_SESSION["user"]->getId());
                $connected = $test->findConnected();
            }
            // var_dump("toto");die;
            Session::addFlash("connected",$connected);
            unset($_SESSION["user"]);
            unset($_SESSION["admin"]);
            unset($_SESSION["connect"]);
            unset($_SESSION["mes_groupes"]);
            unset($_SESSION["autres"]);
            unset($_SESSION["debut"]);
            header('location:index.php?action=index');
        }
       
        public function deleteUser(){
            // var_dump($_POST);die();
            $man = new MembreManager();
            $man-> deleteUser($_POST["membre_id"]);
            $users = $man->selectUsers();
            Session::addFlash("users",$users);
            // var_dump($_POST);die;
            header('location:index.php?action=sujet');
        }
       
                                       
    }
