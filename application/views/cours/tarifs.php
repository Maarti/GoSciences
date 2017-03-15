<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
      
       <br/>
      <!--<table class="hover stack">
        <thead>
          <tr>
            <th width="150" class="text-center">Classe</th>
            <th width="200" class="text-center">Tarif</th>
          </tr>
        </thead>
        <tbody>
        <? foreach ($tarifs as $tarif) {?>
          <tr>
              <td class="text-center"><b><span data-tooltip aria-haspopup="true" class="has-tip" data-disable-hover="false" tabindex="1" title="<?=$tarif['description']?>"><?=$tarif['libelle']?></span></b></td>
            <td class="text-center"><span class="stat"><?=$tarif['tarif_remise']?>€<?=$tarif['unite_remise']?></span><br>
                <span class="price_detail"><?=$tarif['tarif_brut']?>€<?=$tarif['unite_remise']?> avant déduction fiscale</span>
            </td>
          </tr>
        <? } ?>          
        </tbody>
      </table>
        
        
       <br/><br/><br/>-->
       <table class="hover stack">
        <thead>
          <tr>
            <th width="150">Classe</th>
            <th>Descritpion</th>
            <th width="200">Tarif</th>
          </tr>
        </thead>
        <tbody>
            <? foreach ($tarifs as $tarif) {?>
          <tr>
            <td class="text-center"><b><?=$tarif['libelle']?></b></td>
            <td><?=$tarif['description']?></td>
            <td class="text-center"><span class="stat"><?=$tarif['tarif_remise']?>€<?=$tarif['unite_remise']?></span><br>
                <span class="price_detail"><?=$tarif['tarif_brut']?>€<?=$tarif['unite_remise']?> avant déduction fiscale</span>
            </td>
          </tr>
        <? } ?>                
        </tbody>
      </table>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>