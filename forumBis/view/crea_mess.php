<?php 
if(isset($_GET["sujet_id"])){
    $sujet_id = $_GET["sujet_id"];
    $id = $_SESSION["user"]->getId();
    if(isset($result["data"]["subMess"])){
        $subMess = $result["data"]["subMess"];        
    }
    else{
        $subMess = false;
    }
}
else{
    $sujet_id = '';
}
?>
<div class="list_sujet">
    <div class='cache_crea_mess'>
        <p>Ecrire un message</p>
    </div>
    <div class="crea_mess cacher hide">
        <form action="index.php?ctrl=mess&action=crea_mess&sujet_id=<?php echo $sujet_id ?>" method="POST" enctype="multipart/form-data">
            <input class="mess_create" type="hidden" name="membre_id" value="<?= $id ?>">
            <textarea class="mess_create" name="content" placeholder="Votre message ici..." cols="100" rows="10"></textarea>
            <!-- <input class="input" placeholder="Votre message ici..." type="text" name="content"> -->
            <div>
                <label for="photo" class="label-file"><span class="label_photo"> choisir une image(option) </span><i class="far fa-2x fa-image"></i></label>
                <input  type="file" class="input-file" name="photo" id="photo" onchange="readURL(this);">
                <img id="blah" src="public/images/no.jpg" alt="your image" />
                <input type="hidden" name="sujet_id" value="<?= $sujet_id ?>">
                <input type="submit" class=" button_form" name="crea_mess">
            </div>
        </form>
    </div>
    <?php
    // var_dump($result["data"]);die;
    if(!is_object( $result["data"]["sujet"])){
        $sujet = $result["data"]["sujet"];
    }
    else{
        $sujet = $result["data"]["sujet"]->getTitre();
    }
    ?>
    <h4> Titre du sujet : <?php echo $sujet ?></h4>
    <span>par: <?php echo $result["data"]["sujet"]->getMembre()->getPseudo()?></span>
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
                        $sujet_id = $value->getSujet()->getId();
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
                    $sujet_id = $result["data"]["mess"]->getSujet()->getId();
                    // var_dump($sujet_id);die;
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
