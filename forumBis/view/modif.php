
<div class="list_sujet">
    <div class='bordure'>
    <div class='head_mess'>  
    <p>Auteur :<?php echo $result["data"]["mess"]->getMembre()->getPseudo()?></p>
    <p>date :<?php echo $result["data"]["mess"]->getDate()?></p>      
        <div class="post">
        <div class="post_titre">
            <!-- <div class="photo"> -->
                <?php
                if($result["data"]["mess"]->getPhoto() == ""){
                    $photo ="public/images/no.jpg";
                }
                else{
                    $photo =$result["data"]["mess"]->getPhoto();
                }
                ?>
                <img class="photo"src="<?php echo $photo?>" alt="">
            <!-- </div> -->
            <span> <form action="index.php?ctrl=mess&action=modifContent" method="POST">
                <input type="text" name="content" value="<?php echo $result["data"]["content"] ?>">
                <input type="hidden" name="id_message" value="<?php echo $result["data"]["mess"]->getId() ?>">
                <input type="hidden" name="membre_id" value="<?php echo $result["data"]["mess"]->getMembre()->getId() ?>">
                <input type="hidden" name="sujet_id" value="<?php echo $result["data"]["mess"]->getSujet()->getId() ?>">
                <input type="submit">
            </form></span>
        </div>
                
    </div>
</div>
    </div>
    </div>