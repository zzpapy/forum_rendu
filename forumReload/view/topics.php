<a class="new_subject" href="index.php?ctrl=forum&action=creaTopic">Nouveau sujet</a> 
<?php 
    foreach ($result["data"]["topics"] as $topic) {
        $id = $topic->getId();
        $title = $topic->getTitle();
        $author = $topic->getUser()->getUsername();
        $date = $topic->getCreationdate();
        $avatar = $topic->getUser()->getAvatar();
        $closed = $topic->getClosed();
        if($closed == 0){
            $img = '<i class="fas fa-lock-open"></i>';

        }
        else{
            $img = '<i class="fas fa-lock"></i>';
        }
        if($avatar){
            $avatar = $topic->getUser()->getAvatar();
        }
        else{
            $avatar = 'public/img/avatar.png';
        }
        ?>
        <div class="flex title">
            <div  id="<?= $id ?>" class="command_op hide" width="5%">
            <?php $admin = in_array("ROLE_ADMIN",$_SESSION["user"]->getRoles());
             if ($_SESSION["user"]->getId() == $topic->getUser()->getId() || $admin) { ?>
            <form class="command" action="index.php?ctrl=forum&action=closeTopic&id=<?php echo $topic->getId() ?>" method="POST">
                <input type="hidden" name="user_id" value="<?php echo $topic->getUser()->getId() ?>">
                <input type="hidden" name="topic_id" value="<?php echo $topic->getId() ?>">
                <button class=""><?= $img ?></button>
            </form>
            <td class="command_op hide" width="5%">
            <form class="command" action='index.php?ctrl=forum&action=deleteTopic&id=<?php echo $topic->getId() ?>' method='POST'>
                <input type="hidden" name="user_id" value="<?php echo $topic->getUser()->getId() ?>">
                <input type="hidden" name="topic_id" value="<?php echo $topic->getId() ?>">
                <button><span class='fas fa-times-circle'></button>
            </form>
            </td>
            <?php } ?>
            </div>
            <div  width="10%"><div name="<?= $id ?>" class="outils">outils</div></div>
            <a class="flex flex_a" href="index.php?ctrl=forum&action=viewTopic&id=<?= $topic->getId() ?>">
            <?php if($closed == 1){
                ?>
                <div><span class=''><i style="color:red"class='fas fa-2x fa-ban'></i></span></div>
           <?php } ?>
            <div class="title_avatar">
                <img src="<?= $avatar ?>" alt="">
            <div style="text-align:center">
                <?= $author ?>
            </div>
            </div>
            <div style="flex:1;text-align:center">
                <?= $title ?>
            </div>
            </a>
            <div style="flex:0">
            <?= $date ?>
            </div>
        </div>
   <?php }
?>