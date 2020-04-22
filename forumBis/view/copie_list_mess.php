<div class='bordure'>
    <div class='head_mess'>
        <div><?php echo $pseudo ?></div>
        <?php
        // var_dump($sujet_id);die;
        if (isset($author_signal)) {
            echo "Signalé par:" . $author_signal;
        }
        ?>
        <form action="index.php?ctrl=mess&action=signal" method="POST">
            <input type="hidden" name="message_id" value="<?php echo $id_mess; ?>">
            <input type="hidden" name="membre_id" value="<?php echo $id; ?>">
            <input type="hidden" name="sujet_id" value="<?php echo $id; ?>">
            <input type="hidden" name="signal">
            <button class=""><i class="far fa-2x fa-hand-paper"></i></button>
        </form>
        <div><?php echo $date ?></div>
        <?php
        if (isset($_SESSION["user"])) {
            if ($user->getId() == $author || isset($_SESSION["admin"])) { ?>
                <div>
                    <form action='index.php?ctrl=mess&action=delete' method='POST'>
                        <input type="hidden" name="message_id" value="<?php $id_mess ?>">
                        <input type="hidden" name="membre_id" value="<?php $id ?>">
                        <input type="hidden" name="sujet_id" value="<?php $sujet_id ?>">
                        <button><span class=' fa-2x fas fa-times-circle'></button>
                    </form>
                </div>"
                <form action="index.php?ctrl=mess&action=modif" method="POST">
                    <input type="hidden" name="message_id" value="<?php echo $id_mess; ?>">
                    <input type="hidden" name="membre_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="sujet_id" value="<?php echo $sujet_id ?>">
                    <button class=""><i class="fas fa-2x fa-edit"></i></button>
                </form>
        <?php
            }
        };
        ?>
    </div>
    <div class="post">
        <div class="post_titre">
            <div>
                <?php
                if ($photo == "") {
                    $photo = "public/images/no.jpg";
                } else {
                    $photo = $photo;
                }
                ?>
                <img class="photo" src="<?php echo $photo ?>" alt="">
            </div>
            <div><?php echo $content ?></div>
        </div>

    </div>
    <div class='subMess'>
        <h3>commentaires</h3>
        <span>ajouter un commentaire à cette publication</span>
        <form action='index.php?ctrl=mess&action=subMess&sujet_id=<?php echo $sujet_id ?>' method='POST'>
            <input class='input' type='text' name='content' value=''>
            <input type="hidden" name="membre_id" value="<?php echo $id ?>">
            <input type="hidden" name="message_id" value="<?php echo $id_mess ?>">
            <input type='submit'>
        </form>

        <div>
            <?php

            if ($subMess) {
                if (!is_object($subMess)) {
                    foreach ($result["data"]["subMess"] as $key => $value) {
                        if ($value->getMessage()) {
                            if ($value->getMessage()->getId() == $id_mess) { ?>
                                <div class='message_list sub'>
                                    <div class='mess'>
                                        <div>
                                            <p>Auteur :<?php $value->getMembre()->getPseudo() ?></p>
                                        </div>
                                        $date = new \DateTime($value->getDate());
                                        $date = $date->format('d/m/Y H:i');
                                        <div class='content_sub'>contenu:<p class='content_mess'><?php $value->getContent() ?></p>
                                        </div>
                                        <div>date :<?php $date ?></div>
                                        <div>by : ".$pseudo ?></div>
                                    </div>
                                </div>
                                <div class='separator'></div>
                        <?php }
                        }
                    }
                } else {
                    if ($result["data"]["subMess"]->getId() == $id_mess) { ?>
                        <div class='message sub'>
                            <div class='head_mess'>";
                                <div>Auteur :<?php $result["data"]["subMess"]->getMembre()->getPseudo() ?></div>
                                <?php
                                $date = new \DateTime($result["data"]["subMess"]->getDate());
                                $date = $date->format('d/m/Y H:i');
                                ?>
                                <div class='content_sub'>contenu:<p class='content_mess'><?php $result["data"]["subMess"]->getContent() ?></p>
                                </div>
                                <div>date :<?php $date ?></div>
                                // <div>id submes : <?php $result["data"]["subMess"]->getId() ?></div>
                            </div>
                        </div>
                <?php
                    }
                }
            } else {
                ?>
                <div><?php $msg ?></div>";
            <?php
            }
            ?>
        </div>
    </div>
</div>