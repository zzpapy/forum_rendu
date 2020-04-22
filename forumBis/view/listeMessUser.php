<?php 
// var_dump($result["data"]["mess"]);
if(isset($_GET["sujet_id"])){
    $sujet_id = $_GET["sujet_id"];
    $id = $_SESSION["user"]->getId();
    if(isset($result["data"]["subMess"])){
        $subMess = $result["data"]["subMess"];
        
    }
    else{
        $subMess = false;
    }
    // var_dump($_SESSION);die;
    
}
else{
    $sujet_id = '';
}
if(isset($result["data"]["subMess"])){
    $subMess = $result["data"]["subMess"];
    
}
else{
    $subMess = false;
}
?>
<div class="list_sujet">


<div class="block_mess">
        <p>liste des messages</p>
        <?php 
        $msg = "";
            if($result["data"]["mess"] !=NULL){
                if(!is_object($result["data"]["mess"])){
                    foreach ($result["data"]["mess"] as $key => $value) {
                        $user = $_SESSION["user"];
                        $id_mess = $value->getId();
                        $author = $value->getMembre()->getId();
                        $pseudo = $value->getMembre()->getPseudo();
                        $date = $value->getDate();
                        $date = new \DateTime($date);
                        $date = $date->format('d/m/Y H:i');
                        $photo = $value->getPhoto();
                        $content = $value->getContent();

                        include('liste_mess.php');
                    }
                }
                else{
                    $id_mess = $result["data"]["mess"]->getId();
                    $author = $result["data"]["mess"]->getMembre()->getId();
                    $user = $_SESSION["user"];
                    $pseudo = $result["data"]["mess"]->getMembre()->getPseudo();
                    $date = $result["data"]["mess"]->getDate();
                    $photo = $result["data"]["mess"]->getPhoto();
                    $date = new \DateTime($date);
                    $date = $date->format('d/m/Y H:i');
                    $content = $result["data"]["mess"]->getContent();
                    include('liste_mess.php'); 
                }
            }
            else{
                $msg =  "<h2> Syoez le premier à rédiger un message sur ce sujet</h2>";
            }
            ?>
    </div>
    </div>