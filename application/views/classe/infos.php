<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
  
        <ul class="accordion" data-accordion role="tablist">
        <? foreach ($matieres as $key=>$matiere) {?>
            <li class="accordion-item <?= ($key==0)? 'is-active' : ''?>"  data-accordion-item>
                <a href="#<?=$matiere->id?>" role="tab" class="accordion-title" id="<?=$matiere->id?>-heading" aria-controls="<?=$matiere->id?>">
                    <?=$matiere->libelle?>
                </a>
                <div id="<?=$matiere->id?>" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="<?=$matiere->id?>-heading">
                    <?=$matiere->description?>
                </div>
            </li>
        <?}?>
        </ul>   

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>