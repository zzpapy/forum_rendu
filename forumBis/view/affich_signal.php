
<div class="list_sujet">
    
    <div class="block_mess">
        <?php 
        $msg = "";
        if($_SESSION["signal"] !=NULL){
            if(!is_object($_SESSION["signal"])){
                foreach ($_SESSION["signal"] as $key => $value) {
                    $user = $_SESSION["user"];
                    $id_mess = $value->getMessage()->getId();
                    $author = $value->getMessage()->getMembre()->getPseudo();
                    $author_signal = $value->getMembre()->getPseudo();
                    if($value->getMessage()->getSujet() != false){
                        $sujet_id = $value->getMessage()->getSujet()->getTitre();
                    }
                    else{
                        $sujet_id = "titre du sujet non disponible";
                    }
                    // var_dump($sujet_id);die;
                    $pseudo = $value->getMembre()->getPseudo();
                    $photo = $value->getMessage()->getPhoto();
                    $date = $value->getDate();
                    $date = new \DateTime($date);
                    $date = $date->format('d/m/Y H:i');
                    $content = $value->getMessage()->getContent();
                    $subMess= "";
                    include('liste_mess.php');
                }
            }
            else{
                $id_mess = $_SESSION["signal"]->getMessage()->getId();
                $photo = $_SESSION["signal"]->getMessage()->getPhoto();
                $author = $_SESSION["signal"]->getMessage()->getMembre()->getId();
                $pseudo = $_SESSION["signal"]->getMessage()->getMembre()->getPseudo();
                // var_dump($author);die;
                $author_signal = $_SESSION["signal"]->getMembre()->getPseudo();
                $sujet_id = $_SESSION["signal"]->getMessage()->getSujet()->getTitre();
                $user = $_SESSION["user"];
                // $pseudo = $_SESSION["signal"]->getMembre()->getPseudo();
                $date = $_SESSION["signal"]->getDate();
                $date = new \DateTime($date);
                $date = $date->format('d/m/Y H:i');
                $content = $_SESSION["signal"]->getMessage()->getContent();
                $subMess= "";
                // var_dump($content);die;
                include('liste_mess.php'); 
                }
            }
            else{
                echo  "<h2> Aucun signalement</h2>";
                // var_dump($msg);die;
            }
            ?>
    </div>
</div>
