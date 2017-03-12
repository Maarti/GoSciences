<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
        <? if (isset($msg)) echo $msg; ?>
        <?= form_open('site/valid_contact','data-abide'); ?>
      
        <label>Nom
            <input type="text" name="nom" value="<?php echo set_value('nom',$nom); ?>" maxlength="50" placeholder="Nom" required>
            <?= form_error('nom'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom" value="<?= set_value('prenom',$prenom) ?>" maxlength="50" placeholder="Prénom" required>
            <?= form_error('prenom'); ?>
        </label>
        
        <label>E-mail
            <input type="email" name="mail" value="<?= set_value('mail',$mail) ?>" size="254" placeholder="exemple@domaine.fr" required>
            <?= form_error('mail'); ?>
        </label>
        
        <label>Motif
            <select name="motif">
              <option value="info" <?=set_select('motif', 'info', TRUE)?>>Demande d'information</option>
              <option value="postulation" <?=set_select('motif', 'postulation')?>>Postulation pour être professeur</option>
              <option value="bug" <?=set_select('motif', 'bug')?>>Rapport de bug</option>
              <option value="autre" <?=set_select('motif', 'autre')?>>Autre</option>
            </select>
            <?= form_error('motif'); ?>
        </label>

        <label>Message
            <textarea name="message" placeholder="Votre message" rows="10" maxlength="2000" autofocus required><?= set_value('message') ?></textarea>
            <?= form_error('message'); ?>
        </label>
        
        <div class="clearfix">
            <div class="float-right">
                <input type="submit" class="button" value="Valider">
            </div>
        </div>

        </form>
        
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>