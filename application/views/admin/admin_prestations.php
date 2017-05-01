<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
        
        <? $this->load->view('include/admin_menu'); ?>
        
  
        <ul class="accordion" data-accordion data-multi-expand="true" role="tablist">
            <li class="accordion-item is-active" data-accordion-item>
                <a href="#demande" role="tab" class="accordion-title" id="demande-heading" aria-controls="demande">
                    <h5><strong>Demandes en attente de votre réponse</strong></h5>
                </a>
                <div id="demande" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="demande-heading">
                  <?if (empty($demandes)){?>
                     <em class="text-center" style="display:block;">Aucune demande</em>
                  <?}else{?>
                  <table class="hover">
                    <tbody>
                      <? foreach ($demandes as $d){ ?>
                      <tr onclick="document.location.href='<?=site_url('admin/faire_proposition/'.$d->id)?>'">
                        <td width="80"><?=$d->date_creation?></td>
                        <td width="150"><?=$d->libelle?></td>
                        <td><?=$d->nom?> <?=$d->prenom?></td>
                        <td width="100"><a href="<?=site_url('admin/faire_proposition/'.$d->id)?>" class="button"><i class="fi-eye"></i> Voir</a></td>
                      </tr>
                      <?} ?>
                    </tbody>
                  </table>
                  <?}?>
                </div>
            </li>
        </ul>
        
    </div>

</div>