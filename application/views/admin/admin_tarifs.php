<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
  
      <? $this->load->view('include/admin_menu'); ?>

      <ul class="tabs" data-active-collapse="true" data-tabs id="collapsing-tabs">
        <? foreach ($prestations as $key=>$p) {
            $statut = '';
            if ((!empty($id_prest) && $p['id']==$id_prest) || (empty($id_prest) && $key==0))
                $statut = ' is-active';
                $aria = ' aria-selected="true"'?>
            <li class="tabs-title<?=$statut?>">
                <a href="#onglet-<?=$p['id']?>"<?=$aria?>>
                    <?=$p['libelle']?>
                </a>
            </li>
        <?}?>        
      </ul>

    <div class="tabs-content" data-tabs-content="collapsing-tabs">
      <? foreach ($prestations as $key=>$p) {?>
      <div class="tabs-panel<?=($key==0)? ' is-active' : ''?>" id="onglet-<?=$p['id']?>">
        <table class="hover">
        <thead>
          <tr>
            <th>Classe</th>
            <th>Tarif brut</th>
            <th>Tarif remise</th>
            <th>Unité</th>
            <th>Nb Séances</th>
            <th>Durée Séance</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?foreach ($tarifs[$p['id']] as $t){?>
          <tr>
            <td><?=$t['libelle']?></td>
            <td><?=$t['tarif_brut']?></td>
            <td><?=$t['tarif_remise']?></td>
            <td><?=$t['unite_remise']?></td>
            <td><?=$t['nb_seance']?></td>
            <td><?=$t['duree_seance']?></td>
            <td><a data-open="modal-<?=$p['id'].'-'.$t['classe_id']?>" class="button"><i class="fi-page-edit"></i></a></td>
          </tr>
        <?}?>
        </tbody>
       </table>
      </div>
      <?}?>
    </div>
       
    <?foreach ($prestations as $p) {
        foreach ($tarifs[$p['id']] as $t){?>
    
        <div class="reveal" id="modal-<?=$p['id'].'-'.$t['classe_id']?>" data-reveal>
            <h1><?=$t['libelle']?></h1>
            <p class="lead">Modification :</p>
            <?= form_open('admin/valid_tarifs/'.$p['id'].'/'.$t['classe_id'],'data-abide'); ?>
            <label>Tarif brut
            <input type="number" step="0.05" min="0" max="9999.99" name="tarif_brut" value="<?=set_value('tarif_brut',$t['tarif_brut']); ?>"  placeholder="100.00" autofocus>
            <?= form_error('tarif_brut'); ?>
            </label>
            
            <label>Tarif remise
            <input type="number" step="0.05" min="0" max="9999.99" name="tarif_remise" value="<?=set_value('tarif_remise',$t['tarif_remise']); ?>"  placeholder="100.00">
            <?= form_error('tarif_remise'); ?>
            </label>
            
            <label>Unité
            <select name="unite_remise">
              <? foreach($enum_unite_remise as $unit) {
                $flag = ($unit==$t['unite_remise']) ?>
                <option value="<?=$unit?>" <?=set_select('unite_remise', $unit, $flag)?>><?=$unit?></option>
              <?}?>
            </select>
            <?= form_error('unite_remise'); ?>
            </label>
            
            <label>Nb séances
            <input type="number" step="1" min="0" max="999" name="nb_seance" value="<?=set_value('nb_seance',$t['nb_seance']); ?>"  placeholder="2">
            <?= form_error('nb_seance'); ?>
            </label>
            
            <label>Durée séance
            <input type="number" step="0.25" min="0" max="24" name="duree_seance" value="<?=set_value('duree_seance',$t['duree_seance']); ?>"  placeholder="2.00">
            <?= form_error('duree_seance'); ?>
            </label>
        <div class="clearfix">
            <div class="float-right">
                 <input type="submit" class="button" value="Valider">
            </div>
        </div>

        </form>
            <button class="close-button" data-close aria-label="Fermer" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?}}?>
       
    <br>
 </div>    

</div>