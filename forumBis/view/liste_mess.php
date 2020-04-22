<table class=''>
    <tr class=''>
        <td valign="top">
            <div><?php echo $pseudo ?></div>
            <div><?php echo $date ?></div>
            <?php
            // var_dump($sujet_id);die;
            if (isset($author_signal)) { ?>
                Signalé par:<?php echo $author_signal ?>
            <?php
            }
            ?>
        </td>
</td>
<td class="post" colspan="2">
    <div class="contain_command">
        <form class="command" action="index.php?ctrl=mess&action=signal" method="POST">
            <input type="hidden" name="message_id" value="<?php echo $id_mess; ?>">
            <input type="hidden" name="membre_id" value="<?php echo $id; ?>">
            <input type="hidden" name="sujet_id" value="<?php echo $sujet_id; ?>">
            <input type="hidden" name="signal">
            <button class=""><i class="far fa-2x fa-hand-paper"></i></button>
        </form>
    <?php
    if (isset($_SESSION["user"])) {
        if ($user->getId() == $author || isset($_SESSION["admin"])) { ?>
            <form class="command" action='index.php?ctrl=mess&action=delete' method='POST'>
                <input type="hidden" name="message_id" value="<?php echo $id_mess ?>">
                <input type="hidden" name="membre_id" value="<?php echo $id ?>">
                <input type="hidden" name="sujet_id" value="<?php echo $sujet_id ?>">
                <button><span class=' fa-2x fas fa-times-circle'></button>
            </form>
            <form class="command" action="index.php?ctrl=mess&action=modif" method="POST">
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
        <div class="content_table"><?php echo $content ?></div>
    </div>

</td>
    </tr>
    <tr>
        <td class='subMess' valign="top">
            <h3>commentaires</h3>
            <span>ajouter un commentaire à cette publication</span>
            <form action='index.php?ctrl=mess&action=subMess&sujet_id=<?php echo $sujet_id ?>' method='POST'>
                <input class='input' type='text' name='content' value=''>
                <input type="hidden" name="membre_id" value="<?php echo $id ?>">
                <input type="hidden" name="message_id" value="<?php echo $id_mess ?>">
                <input type='submit'>
            </form>
        </td>
    
        <?php
            if ($subMess) {
                if (!is_object($subMess)) {
                    foreach ($result["data"]["subMess"] as $key => $value) {
                        if ($value->getMessage()) {
                            // var_dump($value->getMembre());
                            if ($value->getMessage()->getId() == $id_mess) { ?>
                            <td class="separator min" valign="top">
                                
                                <div class='message_list sub'>
                                    <div class='mess'>
                                <div>
                                    <?php
                                        if($value->getMembre()){ ?>
                                        <span><?php echo $value->getMembre()->getPseudo() ?></span>

                                       <?php } ?>
                                </div>
                                <?php
                                $date = new \DateTime($value->getDate());
                                $date = $date->format('d/m/Y H:i');
                                ?>
                                </div>
                                <div><?php echo $date ?></div>
                            </td>
                            <td class="separator" valign="top">
                                        <div class='content_sub'><p class='content_mess'><?php echo $value->getContent() ?></p>
                                    </div>
                                </div>
                            </td>
                            </tr>
                            <td></td>
                        <?php }
                        }
                    }
                } else {
                    if ($result["data"]["subMess"]->getId() == $id_mess) { ?>
                        <div class='message sub'>
                            <div class='head_mess'>
                                <div>Auteur :<?php echo $result["data"]["subMess"]->getMembre()->getPseudo() ?></div>
                                <?php
                                $date = new \DateTime($result["data"]["subMess"]->getDate());
                                $date = $date->format('d/m/Y H:i');
                                ?>
                                <div class='content_sub'>contenu:<p class='content_mess'><?php echo  $result["data"]["subMess"]->getContent() ?></p>
                                </div>
                                <div>date :<?php $date ?></div>
                                // <div>id submes : <?php echo $result["data"]["subMess"]->getId() ?></div>
                            </div>
                        </div>
                <?php
                    }
                }
            } else {
                ?>
                <div><?php echo $msg ?></div>
            <?php
            }
            ?>
        </td>
    </tr>
</table>