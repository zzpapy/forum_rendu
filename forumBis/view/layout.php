<?php use App\Session; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Forum" />
    <meta name="description" content="Forum réalisé dans le cadre de ma formation CDA">
    <meta property="og:url" content="https://www.manucloud.ddns.net/forumBis" />
    <meta property="og:description" content="Forum réalisé dans le cadre de ma formation CDA">
    <meta property="og:image" itemprop="image" content="//manucloud.ddns.net/forumBis/public/images/acheter-un-chat.jpg">
    <!-- <meta property="og:image" itemprop="image" content="//manucloud.ddns.net/forum/public/images/acheter-un-chat.jpg"> -->
    <meta property="og:type" content="website" />
    <meta property="og:locale:alternate" content="fr_FR" />



    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="icon" type="image/jpg" href="public/images/acheter-un-chat.jpg" />
   
    <title>Forum formation CDA</title>
</head>
<body>
<div id="fb-root"></div>
    <link itemprop="thumbnailUrl" href="http://manucloud.ddns.net/forumBis/public/images/acheter-un-chat.jpg"> <span itemprop="thumbnail" itemscope itemtype="http://manucloud.ddns.net/forum/public/images/acheter-un-chat.jpg"> <link itemprop="url" href="http://manucloud.ddns.net/forum/public/images/acheter-un-chat.jpg"> </span>
<div class="modal close hide">
    <div class="affich .transform flex">
        <div class="arrow carousel" data-direction="prev">
            <i class="fas fa-arrow-left fa-2x"></i>
        </div>
        <div class="center_modal">
            <img id="modal_img" src="">
        </div>
        <div class="arrow1 carousel" data-direction="next">
            <i class="fas fa-arrow-right fa-2x"></i>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="container">
        <div class="what">
            <a href="whatsapp://send?text=http://manucloud.ddns.net/forumBis"><i class="fab fa-2x fa-whatsapp"></i></a>
        </div>
        <div class="burger"><i class="fas fa-3x fa-bars"></i></div>
        <div class="affich_recherche"></div>
        <?php 
        if(isset($_SESSION["user"])){?>
            <div class="pseudo_accueil"><?php echo $_SESSION["user"]->getPseudo() ?></div>

        <?php } ?>
        <?php     
            include (VIEW_DIR.'header.php'); ?>
            <?php echo "<div class='content'>";
            echo $page;
              
            if(!isset($_SESSION["user"]) && $result["view"] != VIEW_DIR.'crea-compte.php'){
                include (VIEW_DIR.'home.php');
            }
            else{
                include (VIEW_DIR.'connected.php');
            }
            echo "</div>";
        ?>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="public/scripts/script.js"></script>

</body>
</html>
