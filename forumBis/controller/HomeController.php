<?php
    namespace Controller;

    use Model\Managers\MembreManager;
    use Model\Managers\SujetManager;
    use Model\Managers\MessageManager;
    use Model\Managers\SubMessManager;
    use Model\Managers\SignalementManager;
    use APP\Session;
    use APP\Upload;
    
    
    class HomeController{

        public function index(){
        //    var_dump($_GET);die;
        
        return [
            "view" =>  VIEW_DIR."sujet.php"];
        }
        
        
        public function sujet(){
            $toto = new MembreManager();
            $connected = $toto->findConnected();
           $findSujet = new SujetManager();
            
            $sujets =$findSujet->findAll();
            $tab = [];
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
            else if($sujets != ''){
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
           
            $test = $toto->selectUsers();
             
            $signal = new SignalementManager();
            $signal = $signal->findAll();
            Session::addFlash( "signal",$signal);
            Session::addFlash("connected",$connected);
            Session::addFlash( "liste",$sujets);
            Session::addFlash( "mess",$tab);
            Session::addFlash( "users",$test);
    
            return [
                "view" => VIEW_DIR."sujet.php",
                "data" =>""
            ];
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
