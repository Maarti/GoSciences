<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
        
        <? if (isset($msg)) echo $msg; ?>
        <?= form_open('utilisateur/valid_connexion','data-abide'); ?>

        <label>E-mail
            <input type="email" name="mail" value="<?php echo set_value('mail',$mail); ?>" size="254" placeholder="exemple@domaine.fr" autofocus required>
            <?= form_error('mail'); ?>
        </label>

        <label>Mot de passe
            <input type="password" name="pass" value="" size="50" placeholder="******" required>
            <?= form_error('pass'); ?>
        </label>

        <div class="clearfix">
            <div class="float-right">
                <small><i><a href="<?= site_url('utilisateur/inscription') ?>">Pas encore inscrit ?</a></i></small> <input type="submit" class="button" value="Valider">
            </div>
        </div>

        </form>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>