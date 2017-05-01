<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
        <? if (isset($msg)) echo $msg; ?>
        
  
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
                      <tr onclick="document.location.href='<?=site_url('prestation/mes_cours')?>'">
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
                      <tr>
                        <td width="80"><?=$dde->date_creation?></td>
                        <td width="150"><?=$dde->libelle?></td>
                        <td><?=$dde->nom?> <?=$dde->prenom?></td>
                        <td width="120">
                            <a href="<?=site_url('prestation/definir_disponibilites/'.$dde->id)?>" class="button" title="Modifier les disponibilités"><i class="fi-pencil"></i></a>
                            <a class="button alert" title="Annuler la demande" data-open="annuler_demande_<?=$dde->id?>"><i class="fi-x"></i></a>
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
                
        <? foreach ($demandes as $dde){ ?>
        <div class="reveal" id="annuler_demande_<?=$dde->id?>" data-reveal>
          <h1>Confirmation</h1>
          <p class="lead">Êtes-vous sûr(e) de vouloir annuler la demande ?</p>
          <div class="clearfix">
            <div class="float-right">
                <button class="button" data-close aria-label="Ferme" type="button">Retour</button>
                <a href="<?=site_url('prestation/annuler_demande/'.$dde->id)?>" class="button alert">Confirmer l'annulation</a>
            </div>
          </div>
          
          <button class="close-button" data-close aria-label="Ferme" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?}?>
    </div>

    <? $this->load->view('include/sidebar'); ?>
</div>