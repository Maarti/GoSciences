<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <?= form_open('utilisateur/valid_inscription','data-abide'); ?>

        <label>E-mail
            <input type="email" name="mail" value="<?=$user->mail?>" maxlength="254" placeholder="exemple@domaine.fr" readonly>
        </label>
        
         <label>Nouveau mot de passe <em>(laissez vide si vous ne souhaitez pas le changer)</em>
            <input type="password" id="newpass" name="newpass" value="" maxlength="50" autocomplete="off">
            <?= form_error('newpass'); ?>
        </label>

        <label id="newpassconf" hidden>Confirmation
            <input type="password" name="newpassconf" value="" maxlength="50" autocomplete="off">
            <?= form_error('newpassconf'); ?>
        </label>
        
        <fieldset>
            <legend>Civilité</legend>
            <input type="radio" name="civilite" value="Mme" id="Mme" <?=set_radio('civilite', 'Mme', $user->civilite=='Mme')?>><label for="Mme">Mme</label>
            <input type="radio" name="civilite" value="M." id="M" <?=set_radio('civilite', 'M.', $user->civilite=='M.')?>><label for="M">M.</label>
        </fieldset>

        <label>Nom
            <input type="text" name="nom" value="<?=set_value('nom',$user->nom)?>" maxlength="50" placeholder="Nom" required>
            <?= form_error('nom'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom" value="<?=set_value('prenom',$user->prenom)?>" maxlength="50" placeholder="Prénom" required>
            <?= form_error('prenom'); ?>
        </label>
        
        <label>Date de naissance
            <input type="date" name="date_naissance" value="<?=set_value('date_naissance',$user->date_naissance)?>" max="2017-07-01" min="1880-01-01" placeholder="2000-01-01">
            <?= form_error('date_naissance'); ?>
        </label>
        
        <label>Téléphone
            <input type="text" name="tel" value="<?=set_value('tel',$user->tel)?>" maxlength="10" placeholder="0600000000">
            <?= form_error('tel'); ?>
        </label>


        <div class="clearfix">
            <div class="float-right">
                <!--<input type="submit" class="button" value="Valider">-->
            </div>
        </div>
        </form>        
        <br/>

    </div>
    <? $this->load->view('include/sidebar'); ?>
    
    
</div>