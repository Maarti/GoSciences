<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-12 columns">
  
        <? $this->load->view('include/admin_menu'); ?>
       
        <?= form_open('admin/valid_textes','data-abide')?>
        <label>Texte  modifier :
            <select name="id">
              <option value="info" <?=set_select('motif', 'info', TRUE)?>>Demande d'information</option>
              <option value="postulation" <?=set_select('motif', 'postulation')?>>Postulation pour être professeur</option>
              <option value="bug" <?=set_select('motif', 'bug')?>>Rapport de bug</option>
              <option value="autre" <?=set_select('motif', 'autre')?>>Autre</option>
            </select>
            <?= form_error('id'); ?>
        </label>
        </form>
        
        <?= form_open('admin/valid_textes','data-abide')?>
        <textarea id="corps" name="mon_texte">Hello, World!</textarea>
        <div class="clearfix">
            <div class="float-right">
                 <input type="submit" class="large button" value="Valider">
            </div>
        </div>
        </form>
        <br>
    </div>
    

</div>