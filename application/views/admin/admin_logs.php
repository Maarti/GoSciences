<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-12 columns">
  
       <? $this->load->view('include/admin_menu'); ?>
       
       <table class="hover">
        <thead>
          <tr>
            <th>Date</th>
            <th>IP</th>
            <th>Agent</th>
            <th>Plate-forme</th>
            <th>Type</th>
            <th>Libellé</th>
            <th>Utilisateur</th>
          </tr>
        </thead>
        <tbody>
            <? foreach ($logs as $l) {?>
            <tr>
              <td><?=$l->date?></td>
              <td><?=$l->ip?></td>
              <td><?=$l->agent?></td>
              <td><?=$l->platform?></td>
              <td><?=$l->type?></td>
              <td><span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" tabindex="10" title="<?=htmlspecialchars($l->detail)?>"><?=$l->libelle?></span></td>
              <td><span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" tabindex="10" title="<?=htmlspecialchars($l->mail)?>"><?=$l->nom.' '.$l->prenom?></span></td>
            </tr>
            <? } ?>
        </tbody>
      </table>

    </div>
    

</div>