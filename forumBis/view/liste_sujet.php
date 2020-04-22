<li class='message sub'>
    <a href='index.php?ctrl=mess&action=crea_mess&sujet_id=<?php echo $sujet_id ?>&close=<?php echo $close ?>&membre_id=<?php echo $membre_id ?>'>
    <div class="views">
    <?php       
        if($photo == ""){
            $photo ="public/images/no.jpg";
        }
        else{
            $photo = $photo;
        }
        ?>
        <div>
            <div>post :<?php echo $nb_post ?></div>
            <div>views :<?php echo $views ?></div>
            <img class="photo_sujet"src="<?php echo $photo?>" alt="">
        </div>
        <div class="titre_mess">
            <div class="flex">
                <div>by : <?php echo $by." " ?></div>
                <div> <?php echo $date ?></div>
            </div>
            <div class="titre_mob"><?php echo $titre ?></div>
        </div>
        </a>
<div class="trash">
<?php
if(isset($_SESSION["user"])){
    if($user->getId() == $author || isset($_SESSION["admin"])){
        if($close==0){
            echo "<div><a class='' href='index.php?ctrl=sujet&action=close&id=".$sujet_id."'><span class='fas fa-2x fa-times-circle'></a></div>";
        }
        else{
            echo "<span class=''><i class='fas fa-2x fa-ban'></i></span>";
        }
    }
    
            if($user->getId() == $author || isset($_SESSION["admin"])){
                echo "<form action='index.php?ctrl=sujet&action=deleteSujet&message_id=".$sujet_id."' method='POST'>";
                echo ' <input type="hidden" name="membre_id" value="'.$id.'">
                <input type="hidden" name="sujet_id" value="'.$sujet_id.'">';                
                echo "<button><i class='far fa-2x fa-trash-alt'></i></button>";
                echo "</form>";           

            }
        

};
?>
</div>
</div>
</li>