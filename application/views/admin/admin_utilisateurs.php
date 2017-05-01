<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
  
       <? $this->load->view('include/admin_menu'); ?>
       
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
              <td><a href="#<?=$u->id?>" class="button"><i class="fi-page-edit"></i></a></td>
            </tr>
            <? } ?>
        </tbody>
      </table>
       
    </div>
    

</div>