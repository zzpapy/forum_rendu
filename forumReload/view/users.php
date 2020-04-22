<?php

    $users = $result['data']['users'];
    
?>
<h1>Liste des utilisateurs</h1>
<ul>
<?php
    foreach($users as $user){
        $connect = $user->getConnected();
        if($connect == 1){ ?>
            <li><?= $user->getUsername() ?> , inscrit depuis le : <?= $user->getRegisterdate() ?><span class="connect"></span></li>
       <?php }
       else{ ?>
            <li><?= $user->getUsername() ?> , inscrit depuis le : <?= $user->getRegisterdate() ?></li>
      <?php }
        echo "";
    }
    
?>
</ul>