<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        
        <? $this->load->view('include/admin_menu'); ?>
        
  
        <ul class="accordion" data-accordion data-multi-expand="true" role="tablist">
            <li class="accordion-item is-active" data-accordion-item>
                <a href="#proposition" role="tab" class="accordion-title" id="proposition-heading" aria-controls="proposition">
                    <h5><strong>Propositions</strong></h5>
                </a>
                <div id="proposition" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="proposition-heading">
                  <?if (!empty($propositions)){?>
                    <div class="callout primary">
                        <?=display('proposition_desc')?>
                    </div>
                  <?}?>
                  <table class="hover">
                    <tbody>
                      <? foreach ($propositions as $prop){ ?>
                      <tr onclick="document.location.href='<?=site_url('site/accueil')?>'">
                        <td width="80"><?=$prop->date_creation?></td>
                        <td width="150"><?=$prop->libelle?></td>
                        <td><?=$prop->nom?> <?=$prop->prenom?></td>
                        <td width="100"><a href="" class="button"><i class="fi-eye"></i> Voir</a></td>
                      </tr>
                      <?} ?>
                    </tbody>
                  </table>
                </div>
            </li>
            <li class="accordion-item" data-accordion-item>
                <a href="#demande" role="tab" class="accordion-title" id="demande-heading" aria-controls="demande">
                    <h5><strong>Demandes en cours</strong></h5>
                </a>
                <div id="demande" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="demande-heading">
                    <table class="hover">
                    <tbody>
                      <? foreach ($demandes as $dde){ ?>
                      <tr onclick="document.location.href='<?=site_url('prestation/definir_disponibilites/'.$dde->id)?>'">
                        <td width="80"><?=$dde->date_creation?></td>
                        <td width="150"><?=$dde->libelle?></td>
                        <td><?=$dde->nom?> <?=$dde->prenom?></td>
                        <td width="120">
                            <a href="<?=site_url('prestation/definir_disponibilites/'.$dde->id)?>" class="button" title="Modifier les disponibilités"><i class="fi-pencil"></i></a>
                            <a href="" class="button" title="Supprimer la demande"><i class="fi-x"></i></a>
                        </td>
                      </tr>
                      <?} ?>
                    </tbody>
                  </table>
                </div>
            </li>
            <li class="accordion-item" data-accordion-item>
                <a href="#cours" role="tab" class="accordion-title" id="cours-heading" aria-controls="cours">
                    <h5><strong>Cours</strong></h5>
                </a>
                <div id="cours" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="cours-heading">
                    
                </div>
            </li>
        </ul>
        
    </div>

    <? $this->load->view('include/sidebar'); ?>
</div>