<article>
    <form action="index.php?ctrl=forum&action=modif&id=<?php echo $result['data']->getId() ?>" method="post">
        <textarea name="content" id="" cols="30" rows="10" name ="content">
        <?php echo $result['data']->getContent() ?>
        </textarea>
        <input type="hidden" name="topic_id" value="<?php echo $result['data']->getTopic()->getId() ?>">
        <input type="submit">
    </form>
</article>