<?php
    namespace App;
    use Controller\HomeController;
    use App\Autoloader;
    date_default_timezone_set("Europe/Berlin");
    define('DS', DIRECTORY_SEPARATOR); // le caractère séparateur de dossier (/ ou \)
    // meilleure portabilité sur les différents systêmes.
    define('BASE_DIR', dirname(__FILE__).DS); // pour se simplifier la vie
    define('VIEW_DIR', BASE_DIR."view/");     //le chemin où se trouvent les vues
    
    require("app/Autoloader.php");
    require("app/Session.php");
    Autoloader::register();
    session_start();
//    var_dump($_SESSION);die;
    if(isset($_GET['ctrl'])){
        $ctrlname = $_GET['ctrl'];
    }
    else $ctrlname = "home";
    $tab_class = get_declared_classes();
    
    //Controller/HomeController
    $ctrlname = "Controller\\".ucfirst($ctrlname)."Controller";
    // var_dump(class_exists($ctrlname));die;
   
    
    $id = null;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if(isset($_GET['action'])){
        if($_GET["action"] == "logout"){
            $action = "logout";
        }
        else{
            $action = $_GET['action'];
        }
    }
    else $action = "sujet"; 
    if ( class_exists($ctrlname)){
        $ctrl = new $ctrlname();
        if(method_exists($ctrl, $action)){
            $result = $ctrl->$action($id);
        }
        else{
            // $ctrl = "home";
            $action = "index";
            $msg = "la page demandée n'existe pas";
            $result = $ctrl->$action($id);
            Session::addFlash("error",$msg);
        }
    }
    else{
        $ctrlname = "home";
        $action = "index";
        $ctrlname = "Controller\\".ucfirst($ctrlname)."Controller";
        $ctrl = new $ctrlname();
        $msg = "la page demandée n'existe pas";
        $result = $ctrl->$action($id);
        Session::addFlash("error",$msg);
    }
    if(isset($_SESSION["debut"])){
        if (isset($_SESSION['debut']) && (time() - $_SESSION['debut'] > 600)) {
            header('location:index.php?ctrl=security&action=logout');
        }
        else{
            $_SESSION["debut"] = time();
        }
    }
    if($action == "ajax"){//si l'action était ajax
        echo $result;//on affiche directement le return du contrôleur (càd la réponse HTTP sera uniquement celle-ci)
    }
    else if($action == "recherche"){
        echo($result);
    }
    else{
        ob_start();//démarre un buffer (tampon de sortie)
        /*la vue s'affiche dans le buffer qui devra être inséré
        au milieu du template*/
        include($result['view']);
        // var_dump($result['view']);
        /*je mets cet affichage dans une variable*/
        $page = ob_get_contents();
        /*j'efface le tampon*/
        ob_end_clean();
        /*j'affiche le template principal*/
        include VIEW_DIR."layout.php";
    }
