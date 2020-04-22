
<div class="home">
    <div class="sticky_home">
   
    <div class='users'> <h4><i class="far close_users fa-2x fa-times-circle"></i>membres:<?php echo count($_SESSION["users"]) ?></h4>
        <?php
            foreach ($_SESSION["users"] as $key => $value) {
                $user = $value->getPseudo();
                if(isset($_SESSION["admin"]) && $value->getPseudo() != "zzpapy" ){
                    echo "<form class='deleteUser' action='index.php?action=deleteUser' method='POST'>";
                    echo ' <input type="hidden" name="membre_id" value='.$value->getId().'>';
                    if($value->getConnected()==1 && $value->getPseudo() != "zzpapy"){
                        echo "<div>".$user."<span style='display:inline-block;margin-left:1em' class='isConnect'></span></div>";
                    }
                    else if($value->getConnected()!=1){
                        echo "<div><span>".$user."</span></div>";
                    }
                    echo "<button><span class=' fa-2x fas fa-times-circle'></span></button>";
                    echo "</form>";
                }
                else if(isset($_SESSION["admin"]) && $value->getPseudo() == "zzpapy"){
                    if($value->getConnected()==1){
                        echo "<div><span>".$user." (Admin)</span><span style='display:inline-block;margin-left:1em' class='isConnect'></span></div>";

                    }
                    else{
                        echo "<div>".$user." (Admin)</div>";
                    }
                }
                else{
                    if($value->getConnected()==1 && $value->getPseudo() != "zzpapy"){
                        echo "<div>".$user."<span style='display:inline-block;margin-left:1em' class='isConnect'></span></div>";
                    }
                    else if($value->getConnected()!=1){
                        echo "<div><span>".$user."</span></div>";
                    }
                }
               

            }
            echo "</div>";
        ?>
        <div class="connect_tag">
            <h2>Tag cloud:</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, laboriosam!</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, laboriosam!</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, laboriosam!</p>
        </div>
    </div>
    <div class="list_users">Liste des membres</div>
</div>