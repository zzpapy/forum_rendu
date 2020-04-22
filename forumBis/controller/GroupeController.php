<?php
    namespace Controller;

    use Model\Managers\MembreManager;
    use Model\Managers\SujetManager;
    use Model\Managers\MessageManager;
    use Model\Managers\GroupeManager;
    use Model\Managers\AppartientManager;
    use App\Manager;
    use APP\Session;
use Model\Entities\Appartient;

class GroupeController{
    public function ajout(){
    
        $appart = new AppartientManager();
        foreach ($_POST["pseudo"] as  $value) {
            $data["membre_id"] = $value;
            $data["groupe_id"] = $_POST["groupe_id"];
            $appart->add($data);
        }
        header('location:index.php?ctrl=groupe&action=myGroups&id='.Session::verifUser());
    }
      
       
    public function crea_groupe(){
        $data["nom"] = $_POST["nom"];
        $data["membre_id"] = $_POST["membre_id"];
        $man = new GroupeManager();
        $groupe_id = $man-> add($data);
        unset($data["nom"]);
        $appart = new AppartientManager();
        var_dump($appart);
        foreach ($_POST["pseudo"] as  $value) {
            $data["membre_id"] = $value;
            $data["groupe_id"] = $groupe_id;
            $appart->add($data);
        }
        $data["titre"] = $_POST["titre"];
        $data["membre_id"] = $_POST["membre_id"];
        $man = new SujetManager();
        $man->add($data);
       

        header('location:index.php?ctrl=groupe&action=myGroups&nom='.$_POST["nom"]);
    }
    public function myGroups(){
       
        $post = [];
        $man = new GroupeManager();
        $groupes = $man->findMyGroups(Session::verifUser());
        if(isset($_GET['nom'])){
            // var_dump($_GET['nom']);die;
            $msg = "le groupe '".$_GET['nom']."' vient d'être créé !!!";
            Session::addFlash("success",$msg);
            
        }
        $tab = [];
        $appart = new AppartientManager();
        $participe = $appart->findGroupeParticipe(Session::verifUser());
        if($participe != null){
           
            
            
            $man = new SujetManager();
            if(is_object($participe)){
                $autres = 1;
                Session::addFlash("autres",$autres);
                $groupe = $participe->getGroupe()->getId();
                $id = $groupe;
                $membre_id = $participe->getGroupe()->getMembre()->getId();
                $sujet = $man->findGroupeSujet($groupe);
                $user =  $appart->findGroupeMembre($groupe);
                $nom_groupe = $participe->getGroupe()->getNom();
                array_push($tab,["membre_id"=>$membre_id, "id_groupe"=>$id, "nom_groupe"=>$nom_groupe, "sujet"=>$sujet,"membre"=>$user]);
                $toto = new MessageManager();
                $mess = $toto->messNb($sujet->getId()); 
                $nb_post = $mess["nb"];
                $post[$sujet->getId()] = $nb_post;
                
            }
            else{
                $autres = count($participe);
                Session::addFlash("autres",$autres);
                
                foreach ($participe as  $value) {
                    $id = $value->getGroupe()->getId();
                    $membre_id = $value->getGroupe()->getMembre()->getId();
                    $nom_groupe = $value->getGroupe()->getNom();
                    $sujet = $man->findGroupeSujet($id);
                    $user =  $appart->findGroupeMembre($id);
                    if($sujet != false){
                        array_push($tab,["membre_id"=>$membre_id, "id_groupe"=>$id, "nom_groupe"=>$nom_groupe, "sujet"=>$sujet,"membre"=>$user]);
                    }
                    $toto = new MessageManager();
                    $mess = $toto->messNb($sujet->getId()); 
                    $nb_post = $mess["nb"];
                    $post[$sujet->getId()] = $nb_post;
                    // var_dump($mess);
                    
                }
                
            }
        }
        if($groupes != null){            
          
            $man = new SujetManager();
            $membre =new AppartientManager();
            if(is_object($groupes)){
                $mes_groupes = 1;
                Session::addFlash("mes_groupes",$mes_groupes);
                $membre_id = $groupes->getMembre()->getId();
                $nom_groupe = $groupes->getNom();
                $id = $groupes->getId();
                $sujet = $man->findGroupeSujet($id);
                $user =  $membre->findGroupeMembre($id);
                array_push($tab,["membre_id"=>$membre_id,"id_groupe"=>$id, "nom_groupe"=>$nom_groupe, "sujet"=>$sujet,"membre"=>$user]);
                $toto = new MessageManager();
                $mess = $toto->messNb($sujet->getId()); 
                $nb_post = $mess["nb"];
                $post[$sujet->getId()] = $nb_post;
            }
            else{
                $mes_groupes = count($groupes);
                Session::addFlash("mes_groupes",$mes_groupes);
               
                foreach ($groupes as  $value) {
                    $id = $value->getId();
                    $membre_id = $value->getMembre()->getId();
                    $nom_groupe = $value->getNom();
                    $sujet = $man->findGroupeSujet($id);
                    $user =  $membre->findGroupeMembre($id);
                    if($sujet != false){
                        array_push($tab,["membre_id"=>$membre_id, "id_groupe"=>$id, "nom_groupe"=>$nom_groupe, "sujet"=>$sujet,"membre"=>$user]);
                    }
                    $toto = new MessageManager();
                    $mess = $toto->messNb($sujet->getId()); 
                    $nb_post = $mess["nb"];
                    $post[$sujet->getId()] = $nb_post;
                    // var_dump($mess);
                    
                }
                
            }
        }
        Session::addFlash("mess",$post);
        return [
            "view" => VIEW_DIR."sujet.php",
            "data" =>["groupe"=>$tab]
        ];
    }
    public function delete(){
        $man = new GroupeManager();
        // var_dump($man);die;
        $man-> delete($_POST["groupe_id"]);
        header('location:index.php?ctrl=groupe&action=myGroups');
    }                                   
}
