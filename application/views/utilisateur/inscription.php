<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">

        <h1>Inscription</h1>

        <?= form_open('utilisateur/valid_inscription'); ?>

        <label>E-mail
            <input type="email" name="mail" value="<?php echo set_value('mail'); ?>" maxlength="254" placeholder="exemple@domaine.fr" required>
            <?= form_error('mail'); ?>
        </label>

        <label>Nom
            <input type="text" name="nom" value="<?php echo set_value('nom'); ?>" maxlength="50" placeholder="Nom" required>
            <?= form_error('nom'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" maxlength="50" placeholder="Prénom" required>
            <?= form_error('prenom'); ?>
        </label>

        <label>Mot de passe
            <input type="password" name="pass" value="" maxlength="50" placeholder="******" required>
            <?= form_error('pass'); ?>
        </label>

        <label>Confirmation
            <input type="password" name="passconf" value="" maxlength="50" placeholder="******" required>
            <?= form_error('passconf'); ?>
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