<?php 
foreach ($result["data"]["signals"] as  $post) { 
    // var_dump($post);die;
    ?>
<table class="posts">
    <tr>
        <td>
            <form class="stop_form" action="index.php?ctrl=forum&action=delSignal" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post->getPost()->getId() ?>">
                <button><span class=' fa-2x fas fa-times-circle'></button>
            </form>
        </td>
        <td >Signalé par :<?= $post->getUser()->getUsername() ?></td>
        <td width="25%">le : <?= $post->getCreationdate() ?></td>
    </tr>
    <tr>
        <td class="mess" colspan="3">Message</td>
    </tr>
    <tr>
        <td class="author_post" width="25%">by: <?= $post->getPost()->getUser()->getUsername() ?></td>
    </tr>
    <tr>
        <td width="25%"><?= $post->getPost()->getCreationdate() ?></td>
        <td><?= $post->getPost()->getContent() ?></td>
    </tr>
</table>
<?php } ?>