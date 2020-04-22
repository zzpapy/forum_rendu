<?php
    namespace Controller;

    use Model\Managers\MembreManager;
    use Model\Managers\SujetManager;
    use Model\Managers\MessageManager;
    use Model\Managers\SubMessManager;
    use Model\Managers\SignalementManager;
    use APP\Session;
    use APP\Upload;
    
    
    class MessController{

        public function index(){
           

            return [
                "view" =>  VIEW_DIR."sujet.php"];
        }
       

       

        
        public function crea_mess($id){
            
            if(isset($_SESSION["user"])){
                if(isset($_GET["close"])){
                    $close = $_GET["close"];
                }
                else{
                    $close = 0;
                }
                if($_GET["sujet_id"] != '' && !isset($_GET["signal"]) && !isset($_GET["ok"]) && $close == 0 && $_GET["sujet_id"] != 'Array'){
                    $man = new SujetManager();
                    
                    if(isset($_FILES["photo"]) && $_FILES["photo"]["name"] != ''){
                        if($_FILES["photo"]["size"]>5120640){
                            $msg = "votre photo est trop volumineuse taille max : 500Mo";
                            Session::addFlash("error",$msg);
                        }
                        else{
                            $photo = $this->upload($_FILES);
                            $_POST["photo"] = $photo;
                        }
                    }
                    $sujets = $man->findAll(); 
                    $sujet = $man->findOneById($_GET["sujet_id"])->getTitre();
                    $sub = new SubMessManager();
                    $sub_mess = $sub->findAll();
                    $man = new MessageManager();
                    $log = $man->add($_POST);
                    
                    if($log != ""){
                        $msg = "Un nouveau message viens d'être créer";
                        Session::addFlash("success",$msg);
                    } 
                    $mess = $man->findBySujet($_GET["sujet_id"]);
                    if(!isset($_SESSION["views"][$_GET["sujet_id"]])){
                        Session::addViews($_GET["sujet_id"],1);
                    }
                    else{
                        $_SESSION["views"][$_GET["sujet_id"]]++;
                    }
                    $_POST= "";
                    
                    header('location:index.php?ctrl=mess&action=crea_mess&ok=true&sujet_id='.$_GET["sujet_id"].'&membre_id='.$_SESSION["user"]->getId());die(); 
                }
                else if(isset($_GET["ok"]) && !isset($_GET["signal"])){
                    $man = new SujetManager();
                    $exist = $man->findOneById($_GET["sujet_id"]);
                    // var_dump($exist);die;  
                    if($exist){
                        $sujets = $man->findAll(); 
                        $sujet = $man->findOneById($_GET["sujet_id"]);
                        $sub = new SubMessManager();
                        $sub_mess = $sub->findAll();
                        $man = new MessageManager();
                        $mess = $man->findBySujet($_GET["sujet_id"]);
                        return [
                            "view" => VIEW_DIR."crea_mess.php",
                            "data" => ["mess"=>$mess,"sujet" => $sujet,"subMess"=>$sub_mess]
                        ];
                    }
                    else{
                        $msg = "cest pas d'essayer de forcer";
                            Session::addFlash("error",$msg);
                            
                            return [
                                "view" => VIEW_DIR."sujet.php" ,
                                "data" => "ce compte n'existe pas"                       
                            ];

                    }
                }
                else if(isset($_GET["signal"])){
                    $sujet = new SujetManager();
                    $sujet = $sujet->findOneById($_GET["sujet_id"]);
                    // var_dump($sujet);die;
                    $man = new SignalementManager();
                    // var_dump($_GET);die;
                    $msg = "Ce message à bien été signalé au modérateur";
                    Session::addFlash("success",$msg);
                    $sub = new SubMessManager();
                    $sub_mess = $sub->findAll();
                    $man = new MessageManager();
                    $mess = $man->findBySujet($_GET["sujet_id"]);
                    return [
                        "view" => VIEW_DIR."crea_mess.php",
                        "data" => ["mess"=>$mess,"sujet" => $sujet,"subMess"=>$sub_mess]
                    ];
                }
                else{
                    $man = new SujetManager();
                    $sujets = $man->findAll();
                    if(isset($_GET["close"]) && $_GET["close"]==1){
                        $msg = "ce sujet a été clôturé";
                        Session::addFlash("error",$msg);
                    }
                    return [
                        "view" => VIEW_DIR."sujet.php",
                        "data" => ["liste"=>$sujets]
                    ];
                }
            }
            else{
                
                if(!isset($_SESSION["views"][$_GET["sujet_id"]])){
                    Session::addViews($_GET["sujet_id"],1);
                }
                else{
                    $_SESSION["views"][$_GET["sujet_id"]]++;
                }
                $msg = "vous devez d'abord vous connecter...";
                Session::addFlash("error",$msg);
                $users = new MembreManager();
                $users = $users->selectUsers();
                $man = new SujetManager();
                $mess = new MessageManager();
                $mess = $mess->findAll();
                $sujets = $man->findAll(); 
                Session::addFlash("users",$users);
                Session::addFlash("liste",$sujets);
                Session::addFlash("mess",$mess);
                if(isset($_SESSION["liste"]) && !is_object($_SESSION["liste"]) ){
                    $i = 0;
                    // var_dump($_SESSION["mess"]);die;
                    foreach ($_SESSION["liste"] as $key => $value) {
                        if(array_key_exists($value->getId(),$_SESSION["mess"])){
                            $nb_post = $_SESSION["mess"][$value->getId()];
                        }
                        else{
                            $nb_post = 0;
                        }
                    }
                }
                // var_dump($sujets);die;
                // var_dump($_SESSION);die;
                return [
                    "view" => VIEW_DIR."sujet.php",
                    "data" => ""
                ];
            }
        }
        public function subMess(){
            $sub = new SubMessManager();
            // var_dump($_POST);die;
            $test = $sub->add($_POST);
            $sub_mess = $sub->findAll();
            // var_dump($test);die;
            $man = new MessageManager();
            $mess = $man->findBySujet($_GET["sujet_id"]);
            $man = new SujetManager();
            $sujet = $man->findOneById($_GET["sujet_id"])->getTitre();
            // var_dump($sub_mess);die;
            // $this->crea_mess($_POST);
           header('location:index.php?ctrl=mess&action=crea_mess&sujet_id='.$_GET["sujet_id"].'&membre_id='.$_SESSION["user"]->getId().'');die();
            
            // var_dump($_POST);die;
        }
        public function delete(){
            // var_dump($_POST);die;
            $man = new MessageManager();
            $man-> delete($_POST["message_id"]);
            header('location:index.php?ctrl=home&action=sujet');
        }
        
       
        public function upload($photo){
            // if(isset($_FILES) && !empty($_FILES["fileToUpload"]["name"])){
               
                $up = Upload::uploadFile("photo",$_FILES["photo"]["name"],"public/images/");
                $photo = "public/images/".$up;
                // var_dump($photo);die;
            // }
            
            return $photo;
        }
        public function findPhoto(){
            $man = new MembreManager();
            $photos = $man->findPhoto();
            Session::addFlash("photo",$photos);
            return [
                "view" => VIEW_DIR."gallerie.php",
                "data" => ""
            ];
        }
        
        public function modif($id){
            $man = new MessageManager();
            $test = $man->findOneById($_POST["message_id"]);
            // var_dump($test);die;
            $content = $test->getContent();
            // var_dump($test);die;
            // var_dump($_GET);die;
            return [
                "view" => VIEW_DIR."modif.php",
                "data" => [
                    "mess" => $test,
                    "content" => $content,
                    "sujet_id" => $_POST["sujet_id"]
                ]
            ];
        }
        public function modifContent(){
            // var_dump($_POST);die;
            $man = new MessageManager();
            $man->updateMess($_POST);
           header("location:index.php?ctrl=mess&action=crea_mess&ok=true&sujet_id=".$_POST['sujet_id']."&membre_id=".$_POST['membre_id']);
            return [
                "view" => VIEW_DIR."sujet.php",
                "data" => ""
            ];
        }
        public function signal(){
            // var_dump($_POST);die;
            $man = new SignalementManager();
            $sujet_id = $_POST["sujet_id"];
            unset($_POST["sujet_id"]);
            $sign = $man->add($_POST);
            $signal = $man->findAll();
            $msg = "Ce message à bien été signalé au modérateur";
            Session::addFlash( "signal",$signal);
            Session::addFlash("success",$msg);
            
            header("location:index.php?ctrl=mess&action=crea_mess&ok=true&sujet_id=".$sujet_id."&signal=ok");
            return [
                "view" => VIEW_DIR."sujet.php",
                "data" => ""
            ];
            // header('location:index.php?action=sujet');
        }
        public function affichSignal(){
            return [
                "view" => VIEW_DIR."affich_signal.php",
                "data" => ""
            ];
        }
        public function userMess(){
            $man = new MessageManager();
            // var_dump($_SESSION);die;
            $mess = $man->findByUserId($_SESSION["user"]->getId());
            $sub = new SubMessManager();
            $sub_mess = $sub->findAll();
            // var_dump($mess);die;
            return [
                "view" => VIEW_DIR."listeMessUser.php",
                "data" => ["mess"=>$mess,"subMess"=>$sub_mess]
            ];
        }
                                       
    }
