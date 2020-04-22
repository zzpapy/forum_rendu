<?php use App\Session; ?>
<div class="sticky">
    <!-- <i class='fas change fa-palette fa-3x'></i>
    <input id="choix" class="hide "  type="color"> -->
    <h1 class="titre">Forum
        
    <?php
    if(isset($_SESSION["user"])){
        echo "<span>Bonjour : ".$_SESSION["user"]->getPseudo()."</span>";
    }
    if(isset($_SESSION["admin"])){
        echo "<span>ADMINISTRATEUR</span>";
        echo "<div class='signal'>";

        echo "</div>";
    }
    ?>
    </h1>
    <div class="head">
        
        <?php 
        if(isset($_SESSION["user"])){
            echo "<div>";
            echo "<span>Votre session expire dans : </span>";
            echo "<div style='width: 50%;margin: auto;' id='SecondsUntilExpire'></div>";
            echo "</div>";
        }
        echo "<div class='recherche'>";
        echo "<div class='recherche'>recherche sujet</div>";
        echo "<input type='text' id='recherche'>";
        echo "</div>";
        if(isset($_SESSION["signal"])){
            if(!is_object($_SESSION["signal"])){
                $nb_signal = count($_SESSION["signal"]);
            }
            else{
                $nb_signal = 1;
            }
        }
        else{
            $nb_signal = 0;
        }
        echo "<a href='index.php?action=sujet'>Accueil</a>";
        echo "<a href='index.php?ctrl=mess&action=findPhoto'>Galerie</a>";
        
        
        if(isset($_SESSION["user"])){
            echo "<a href='index.php?ctrl=mess&action=userMess'>mes messages</a>"; 
            echo "<a href='index.php?ctrl=groupe&action=myGroups&id=".$_SESSION["user"]->getId()."'>mes groupes</a>"; 
            echo "<a href='index.php?ctrl=security&action=logout'>logout</a>";
        }               
        if(isset($_SESSION["admin"])){
            echo "<a href='index.php?ctrl=mess&action=affichSignal'>SIGNALEMENT(".$nb_signal.")</a>";
        }
       
        ?>
    </div>
</div>
<div class='affich'></div>
<?php 
    if(isset($_SESSION["connect"])){
        echo "<div class='blink connect_user'></div>";
        
    }
?>
<div class="error">
    <?php 
        if(isset($_SESSION["error"])){
            $msg = SESSION::getFlash("error");
        }
        else{
            $msg = "";
        }
        echo $msg;
    ?>
</div>
<div class="success">
<?php 
        if(isset($_SESSION["success"])){
            // var_dump($_SESSION["success"]);die;
            $msg = SESSION::getFlash("success");
        }
        else{
            $msg = "";
        }
        echo $msg;
    ?>    
</div>