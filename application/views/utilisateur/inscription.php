<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <?= form_open('utilisateur/valid_inscription','data-abide'); ?>

        <label>E-mail
            <input type="email" name="mail" value="<?php echo set_value('mail'); ?>" maxlength="254" placeholder="exemple@domaine.fr" autocomplete="email" autofocus required>
            <?= form_error('mail'); ?>
        </label>
        
        <label>Mot de passe
            <input type="password" id="pass" name="pass" value="" maxlength="50" placeholder="******" required>
            <?= form_error('pass'); ?>
        </label>

        <label>Confirmation
            <input type="password" name="passconf" value="" maxlength="50" placeholder="******" data-equalto="pass" required>
            <?= form_error('passconf'); ?>
        </label>
        
        <fieldset>
            <legend>Civilité</legend>
            <input type="radio" name="civilite" value="Mme" id="Mme" <?=set_radio('civilite', 'Mme',TRUE)?>><label for="Mme">Mme</label>
            <input type="radio" name="civilite" value="M." id="M" <?=set_radio('civilite', 'M.')?>><label for="M">M.</label>
        </fieldset>
        <?= form_error('civilite'); ?>

        <label>Nom
            <input type="text" name="nom" value="<?php echo set_value('nom'); ?>" maxlength="50" placeholder="Nom" autocomplete="family-name" required>
            <?= form_error('nom'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" maxlength="50" placeholder="Prénom" autocomplete="given-name" required>
            <?= form_error('prenom'); ?>
        </label>

        <div class="clearfix">
            <div class="float-right">
                <small><i><a href="<?= site_url('utilisateur/connexion') ?>">Déjà inscrit ?</a></i></small> <input type="submit" class="button" value="Valider">
            </div>
        </div>

        </form>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>