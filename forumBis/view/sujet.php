<div class="list_sujet">
    <!--  -->
    <?php 
    
    if(isset($_SESSION["user"]) ){ ?>
        <div class="menu">
        <div class='cache_crea_sujet'>
        <p>Créer une discussion publique</p></div>
        <div class="crea_sujet hide">
        <form action="index.php?ctrl=sujet&action=crea_sujet" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="membre_id" value=<?php echo$_SESSION["user"]->getId() ?>>
        <input class="input" type="text" placeholder="Titre de la discussion..." name="titre">
        <div>
        <label for="photo" class="label-file"><span class="label_photo"> choisir une image(option)</span> <i class="far fa-2x fa-image"></i></label>
        <img id="blah" src="public/images/no.jpg" alt="your image" />
        <input type="file"class="input-file" name="photo" id="photo" onchange="readURL(this);">
        <input type="submit"  class="button_form" name="crea_sujet">
        </div>
        </form>
        </div>
    <?php } 
    if(isset($_SESSION["autres"])){
        $autres = $_SESSION["autres"];
    }
    else{
        $autres = 0;
    }
    if(isset($_SESSION["mes_groupes"])){
        $mes_groupes = $_SESSION["mes_groupes"];
    }
    else{
        $mes_groupes = 0;
    }
    if(!is_object($_SESSION["liste"]) && $_SESSION["liste"] != ''){
        $nb_sujet = count($_SESSION["liste"]);
    }
    else{
        $nb_sujet = 0;
    }
    if(isset($_SESSION["user"])){
    ?>
    <div class='cache_crea_discuss'>
    <p>Créer un groupe de discussion privé</p>
    </div>
    <div class="crea_discuss hide">
        <form action="index.php?ctrl=groupe&action=crea_groupe" method="POST">
            <input type="text" class="input" name="nom" placeholder="nom du groupe...">
            <p>choisr les partcipants</p>
            <div class="users_groupe">
            <?php
                foreach ($_SESSION["users"] as  $value) { ?>
                <div>
                    <input type="checkbox" id="<?php echo $value->getId() ?>" name="pseudo[]" value="<?php echo $value->getId() ?>">
                    <label for="<?php $value->getId() ?>"><?php echo $value->getPseudo() ?></label>
                </div>
            <?php } ?>
            </div>
            <input type="text" class="input" name="titre" placeholder="titre de la discussion...">
            <input type="hidden" name="membre_id"  value="<?php echo $_SESSION["user"]->getId() ?>">
            <input type="submit" >
        </form>
    </div>
</div>
            <?php } ?>
    <p>Discussions en cours: <?php echo $nb_sujet ?></p>
    <?php
        if(isset($_GET["action"]) && $_GET["action"]  != "sujet"){
            ?>
            <p>Groupes auquels je partcipe: <?php echo ($autres) ?></p>
            <p>Mes groupes: <?php echo ($mes_groupes) ?></p>
            <?php
        }
    ?>
    <ul class="list">
        <?php 
            if(isset($_SESSION["user"])){
                $user = $_SESSION["user"];
                $membre_id = $user->getId();
            }
            else{
                $membre_id =0;
            }
            if(isset($_SESSION["liste"]) && !is_object($_SESSION["liste"]) && isset($_GET["action"]) && $_GET["action"] != "myGroups" || !isset($_GET["action"]) ){
                $i = 0;
                foreach ($_SESSION["liste"] as $key => $value) {
                    
                    $date = new \DateTime($value->getDate());
                    $sujet_id = $value->getId();
                    $close = $value->getClose();
                    $date = $date->format('d/m/Y H:i');
                    $by = $value->getMembre()->getPseudo();
                    $titre = $value->getTitre();
                    $author = $value->getMembre()->getId();
                    $photo = $value->getPhoto();
                    if(isset($_SESSION["views"][$sujet_id])){
                        $views = $_SESSION["views"][$sujet_id];
                    }
                    else{
                        $views = 0;
                    }
                    if(array_key_exists($value->getId(),$_SESSION["mess"])){
                        $nb_post = $_SESSION["mess"][$value->getId()];
                    }
                    else{
                        $nb_post = 0;
                    }
                    include('liste_sujet.php');
                }
            }
            else if(is_object($_SESSION["liste"]) && $_GET["action"] != "myGroups"){
                
                $nb_sujet = 1;
                $close = $_SESSION["liste"]->getClose();
                $sujet_id = $_SESSION["liste"]->getId();
                $date = new \DateTime($_SESSION["liste"]->getDate());
                $sujet_id = $_SESSION["liste"]->getId();
                $date = $date->format('d/m/Y H:i');
                $by = $_SESSION["liste"]->getMembre()->getPseudo();
                $titre = $_SESSION["liste"]->getTitre();
                $message_id = $_SESSION["liste"]->getId();
                $author = $_SESSION["liste"]->getMembre()->getId();
                $photo = $_SESSION["liste"]->getPhoto();
                if(array_key_exists($_SESSION["liste"]->getId(),$_SESSION["mess"])){
                    $nb_post = $_SESSION["mess"][$_SESSION["liste"]->getId()];
                }
                else{
                    $nb_post = 0;
                }
                if(isset($_SESSION["views"][$sujet_id])){
                    $views = $_SESSION["views"][$sujet_id];
                }
                else{
                    $views = 0;
                }
                include('liste_sujet.php');
            }
            else if(isset($_GET["action"]) && $_GET["action"] == "myGroups" && !empty($result["data"]["groupe"])){
                
                if(is_object($result["data"]["groupe"])){
                    
                    $id_groupe = $result["data"]["id_groupe"];
                    $nom_groupe = $result["data"]["nom_groupe"];
                    $date = new \DateTime($result["data"]["sujets"]->getDate());
                    $sujet_id = $result["data"]["sujets"]->getId();
                    $close = $result["data"]["sujets"]->getClose();
                    $date = $date->format('d/m/Y H:i');
                    $by = $result["data"]["sujets"]->getMembre()->getPseudo();
                    $titre = $result["data"]["sujets"]->getTitre();
                    $author = $result["data"]["sujets"]->getMembre()->getId();
                    $photo = $result["data"]["sujets"]->getPhoto();
                    $membres = $result["data"]["membre"];
                    if(isset($_SESSION["views"][$sujet_id])){
                        $views = $_SESSION["views"][$sujet_id];
                    }
                    else{
                        $views = 0;
                    }
                    if(array_key_exists($result["data"]["sujets"]->getId(),$_SESSION["mess"])){
                        $nb_post = $_SESSION["mess"][$value->getId()];
                    }
                    else{
                        $nb_post = 0;
                    }
                    include('head_discuss.php');
                    include('liste_sujet.php');
                }
                else{
                    foreach ($result["data"]["groupe"] as  $value) {
                        $id_groupe = $value["id_groupe"];
                        $nom_groupe = $value["nom_groupe"];
                        if($value["sujet"]){
                            $author = $value["sujet"]->getMembre()->getId();
                            $date = new \DateTime($value["sujet"]->getDate());
                            $sujet_id = $value["sujet"]->getId();
                            $close = $value["sujet"]->getClose();
                            $date = $date->format('d/m/Y H:i');
                            $by = $value["sujet"]->getMembre()->getPseudo();
                            $titre = $value["sujet"]->getTitre();
                            $photo = $value["sujet"]->getPhoto();
                            // var_dump($_SESSION["mess"],$sujet_id);die;
                            if(array_key_exists($sujet_id,$_SESSION["mess"])){
                                $nb_post = $_SESSION["mess"][$sujet_id];
                            }
                            else{
                                $nb_post = 0;
                            }
                        }
                        $membres = $value["membre"];
                        if(isset($_SESSION["views"][$sujet_id])){
                            $views = $_SESSION["views"][$sujet_id];
                        }
                        else{
                            $views = 0;
                        }
                                                
                        include('head_discuss.php');
                        include('liste_sujet.php');
                    }
                }
            }
            else{
                echo "Soyez le premier à créer un sujet de conversation";
            }
        ?>
    </ul>
</div>