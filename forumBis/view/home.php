<?php 
// var_dump($_SESSION);
if(isset($_SESSION["user"])){
    if(isset($result["data"]) && $result["data"] != ''){
        $text = $result["data"];
    }
    else{
        $text = '';
    }
}
else{
    $text = '';
}
// var_dump($_SESSION);
?>
<div class="home">
    <div class="sticky_home">
        <div class='users'><i class="far close_users fa-2x fa-times-circle"></i><h4>membres: <?php echo count($_SESSION["users"])?></h4>
        
        <?php
            foreach ($_SESSION["users"] as $key => $value) {
                $user = $value->getPseudo();
                if( $value->getPseudo() == "zzpapy"){
                    echo "<div><span>".$user." (ADMIN)</span></div>";
                }
                else{
                    echo "<div><span>".$user."</span></div>";
                }
            }
            echo "</div>";
            ?>
        <div class="connect">
            <h2>connectez vous:</h2>
            <form class="form_flex" method="POST" action="index.php?ctrl=security&action=connect">
                <input type="text" name="pseudo" class="pseudo" placeholder="pseudo" required>
                <input type="password" name=password class="password"placeholder="mot de passe"  required>
                <input type="submit" name="connect" class="submit">
            </form>
            <div class="list_users">Liste des membres</div>
            <div class="blink_div">
                <p class="bordure crea_user"><a href="index.php?ctrl=security&action=signIn">Vous n'avez pas encore de compte, cliquez ici</a></p><p><i class="fas blink fa-2x fa-arrow-down"></i></p>
            </div>
        </div>
    </div>
</div>