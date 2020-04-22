<?php
    namespace Controller;

    use Model\Managers\MembreManager;
    use Model\Managers\SujetManager;
    use APP\Session;
    use APP\Upload;
    
    
    class SujetController{

        public function index(){
           

            return [
                "view" =>  VIEW_DIR."sujet.php"];
        }
       

       

        public function crea_sujet($id){
            
            if($_FILES["photo"]["name"] != ''){
                $photo = $this->upload($_FILES);
                $_POST["photo"] = $photo;
            }
            // var_dump($_FILES);die;
            $man = new SujetManager();
            $sujet = $man->add($_POST);  
            $sujets = $man->findAll(); 
            if($sujet != "" && $sujet != "Array"){
                $msg = "Un nouveau sujet viens d'être créer";
                Session::addFlash("success",$msg);
                Session::addFlash("liste",$sujets);
                $ctrl ="mess";
                // var_dump($ctrl);die;
                header('location:index.php?ctrl=mess&action=crea_mess&membre_id='.$_SESSION["user"]->getId().'&sujet_id='.$sujet.'');
                die();
            }
            else{
                
                header(('location:index.php?ctrl=mess&action=crea_mess&membre_id='.$_SESSION["user"]->getId().'&sujet_id='.$sujet.''));
                die();
            }
           
        }
        
        public function recherche(){
            $man = new SujetManager();
            $char = $_GET["nb"];
            $res = $man->recherche($char);
            $i = 0;
            $tab = [];
            if($res){
                if(is_object($res) ){
                    $titre = $res->getTitre();
                   $id = $res->getId();
                    include(VIEW_DIR."ajax.php");
                }
                else{
                    while($i < count($res)){
                        $titre = $res[$i]->getTitre();
                        $id = $res[$i]->getId();
                        
                        // var_dump($photo);
                        include(VIEW_DIR."ajax.php");
                        $i++;           
                    }
                }
            }
            // var_dump($res);
        }
        public function upload($photo){
            // if(isset($_FILES) && !empty($_FILES["fileToUpload"]["name"])){
               
                $up = Upload::uploadFile("photo",$_FILES["photo"]["name"],"public/images/");
                $photo = "public/images/".$up;
                // var_dump($photo);die;
            // }
            
            return $photo;
        }
        public function deleteSujet(){
            $man = new SujetManager();
            $man-> deleteSujet($_POST["sujet_id"]);
            // var_dump($_POST);die;
            header('location:index.php?ctrl=home&action=sujet');
        }
        
        public function close($id){
            $man = new SujetManager();
            $test = $man->close($id);
            $liste= $man->findAll();
            Session::addFlash("liste",$liste);
            // var_dump($test);die;
            return [
                "view" => VIEW_DIR."sujet.php",
                "data" => ""
            ];
        }
        
                                       
    }
