<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-12 columns">
  
            <ul class="menu expanded">
              <li class="active text-center"><a href="<?=site_url('admin/utilisateurs')?>">Utilisateurs</a></li>
              <li class="active text-center"><a href="#">Classes</a></li>
              <li class="active text-center"><a href="<?=site_url('admin/prestations')?>">Prestations</a></li>
              <li class="active text-center"><a href="#">Textes</a></li>
              <li class="active text-center"><a href="#">Logs</a></li>
            </ul>
       <h1 class="text-center"><?=(isset($page_title))? htmlspecialchars($page_title) : 'GoSciences'?></h1>
       
       
       <table class="hover">
        <thead>
          <tr>
            <th>Email</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Tel</th>
            <th>Date naissance</th>
            <th>Date inscription</th>
            <th>Dernière connexion</th>
            <th>État</th>
            <th>Modifier</th>
          </tr>
        </thead>
        <tbody>
            <? foreach ($utilisateurs as $u) {?>
            <tr>
              <td><?=$u->mail?></td>
              <td><?=$u->nom?></td>
              <td><?=$u->prenom?></td>
              <td><?=$u->tel?></td>
              <td><?=$u->date_naissance?></td>
              <td><?=$u->date_inscription?></td>
              <td><?=$u->date_connexion?></td>
              <td><?=$u->etat?></td>
              <td><a href="#<?=$u->id?>" class="button">Modifier</a></td>
            </tr>
            <? } ?>
        </tbody>
      </table>
       
    </div>
    

</div>