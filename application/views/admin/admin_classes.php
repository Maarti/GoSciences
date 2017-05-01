<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
  
      <? $this->load->view('include/admin_menu'); ?>

      <ul class="tabs" data-active-collapse="true" data-tabs id="collapsing-tabs">
        <? foreach ($classes as $key=>$c) {
            $statut = '';
            if ((!empty($id_class) && $c['id']==$id_class) || (empty($id_class) && $key==0))
                $statut = ' is-active';
                $aria = ' aria-selected="true"'?>
            <li class="tabs-title<?=$statut?>">
                <a href="#onglet-<?=$c['id']?>"<?=$aria?>>
                    <?=$c['libelle']?>
                </a>
            </li>
        <?}?>        
      </ul>
        
      <div class="tabs-content" data-tabs-content="collapsing-tabs">
      <? foreach ($classes as $key=>$c) {?>
      <div class="tabs-panel<?=($key==0)? ' is-active' : ''?>" id="onglet-<?=$c['id']?>">
          <?= form_open('admin/valid_classes/'.$c['id'],'data-abide');            
          foreach ($c['disc'] as $disc) {?>
            <p class="lead"><?=$disc['libelle']?></p>
            
            <label>Description
                <input type="text" name="description_<?=$disc['id']?>" value="<?=set_value('description_'.$disc['id'],$disc['description']); ?>"  placeholder="Description courte du programme de <?=$disc['libelle']?>">
                <?= form_error('description'.$disc['id']); ?>
            </label>
            
            <label>Description longue
                <textarea name="description_longue_<?=$disc['id']?>" placeholder="Description longue du programme de <?=$disc['libelle']?>" rows="3" maxlength="50000"><?= set_value('description_longue_'.$disc['id'],$disc['description_longue']) ?></textarea>
                <?= form_error('description_longue'.$disc['id']); ?>
            </label>
            <br>
          <?}?>
          <input type="submit" class="button large expanded" value="Valider">
          </form>
        </div>
        
      <?}?>
    </div>
    
    <br>
    </div>

</div>