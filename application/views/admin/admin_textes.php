<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-12 columns">
  
       <? $this->load->view('include/admin_menu'); ?>
       
         <?= form_open('admin/valid_textes','data-abide')?>
    <textarea id="mytextarea" name="mon_texte">Hello, World!</textarea>
    <input type="submit" class="button" value="Valider">
  </form>

    </div>
    

</div>