<div class="list_sujet">
    <h3>Gallerie photo</h3>
    <div class="gallerie">        
        <?php 
            foreach ($_SESSION["photo"] as $key => $value) {
                if($value["photo"] != "public/images/" && $value["photo"] != "" && $value["photo"] != " " && strpos($value["photo"], 'public') !== false){
                    echo "<div class='photo_gal'><img src='".$value["photo"]."' alt=''></div>";
                }
            }
        ?>
    </div>
</div>