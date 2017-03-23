<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-12 columns">
  
        <? $this->load->view('include/admin_menu'); ?>
       
        <?= form_open('admin/valid_textes','data-abide')?>
        <label>Texte à modifier :
            <select name="id" onchange="this.form.submit()">
              <? foreach ($textes as $txt) {
                    $actif = ($texte->id == $txt->id);?>
                    <option value="<?=$txt->id?>"<?=set_select('id', $txt->id, $actif)?>><?=$txt->libelle?></option>
              <?}?>
            </select>
            <?= form_error('id'); ?>
        </label>
        <input type="hidden" name="form" value="texte_id">
        </form>
        
        
        <?if(!empty($texte)){
            echo form_open('admin/valid_textes/'.$texte->id,'data-abide')?>
            <textarea id="corps" name="corps"><?=$texte->corps?></textarea>
            <div class="clearfix">
                <div class="float-right">
                     <input type="submit" class="large button" value="Valider">
                </div>
            </div>
            <input type="hidden" name="form" value="texte_corps">
            </form>
        <?}?>
    <br>
    </div>
    

</div>