
<div class="profile">
    <div class="username">
        <img class="avatar" src="<?= $_SESSION['user']->getAvatar()?>" alt="avater">
        <form action="index.php?ctrl=home&action=modifAvatar&id=<?= $_SESSION["user"]->getId() ?>" method="post" enctype='multipart/form-data'>
            <strong><input type="file" name="avatar"></strong>
            <strong><input type="submit" value="changer d'avatar"></strong>
        </form>
    </div>
    <div class="username">
        <?= $_SESSION['user']->getUsername()?>
        <form action="index.php?ctrl=home&action=modifUserName&id=<?= $_SESSION["user"]->getId() ?>" method="post" enctype='multipart/form-data'>
            <strong><input type="text" name="username"></strong>
            <strong><input type="submit" value="changer de pseudo"></strong>
        </form>
    </div>
</div>