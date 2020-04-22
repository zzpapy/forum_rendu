<?php 
// session_start();
//  var_dump($result["data"]);
?>
<div class="list_sujet">
    <ul class="list">
        <?php 
        if(isset($result["data"])){
            foreach ($result["data"] as $key => $value) {
                // var_dump($_GET);die;
                echo "<li ><a href='index.php?action=crea_mess&sujet_id=".$value->getId()."&membre_id=".$value->getMembre()->getId()."'>".$value->getTitre()."</a>";
            }
        }
        ?>
    </ul>
</div>
<div class="crea_sujet">
    <form action="" method="POST">
        <input type="hidden" name="membre_id" value="<?= unserialize($_SESSION["user"])->getId() ?>">
        <input class="input" type="text" name="titre">
        <input type="submit" name="crea_sujet">
    </form>
</div>