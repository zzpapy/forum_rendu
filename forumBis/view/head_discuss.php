<?php
use App\Session;
?>
<div class="groupe">
    <h2>
        <?php
            if(isset($nom_groupe) ){
                ?><div> 
                    <?php echo $nom_groupe ?>
                </div>
            <?php
            }
        ?>
    </h2>
    <div class="participe">
        <?php 
        if($author == Session::verifUser() || isset($_SESSION["admin"])){ ?>
        <form class="command" action='index.php?ctrl=groupe&action=delete' method='POST'>
            
            <input type="hidden" name="groupe_id" value="<?php echo  $id_groupe ?>">
            <button><span class=' fa-2x fas fa-times-circle'></button>
        </form>
        <div class="users_discuss ajout">
            <span>Ajouter des particpants</span>
            <form action="index.php?ctrl=groupe&action=ajout" method="POST">
                <div>
                    <?php
                    foreach ($_SESSION["users"] as  $user) {
                        ?>
                    <div>
                        <input type="hidden" name="groupe_id" value=<?php echo $id_groupe ?>>
                        <input type="checkbox" id="<?php echo $user->getId() ?>" name="pseudo[]" user="<?php echo $user->getId() ?>" value="<?php echo $user->getId() ?>">
                        <label for="<?php $user->getId() ?>"><?php echo $user->getPseudo() ?></label>
                    </div>
                    <?php } ?>
                    
                </div>
                <div>
                    <input class="button" type="submit">
                </div>
            </form>
        </div>
        <?php } ?>
        <div class="participants">
            <h4>Participants</h4>
            <?php
            if(is_object($membres)){ ?>
            <div><?php echo $membres->getMembre()->getPseudo() ?></div>
            <?php
            }else{
                // var_dump($membres);die;
                foreach ($membres as $value) {?>
                <div><?php echo $value->getMembre()->getPseudo() ?></div>
                <?php }}
                ?>
        </div>
    </div>
</div>