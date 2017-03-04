<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <h1>GoSciences - 404</h1>
        
        <div class="callout alert" data-closable>
            <h5>La page que vous demandez est introuvable.</h5>
            <p>Nous vous prions de nous excuser pour la gêne occasionée.</p>
            <button class="close-button" aria-label="Fermer" type="button" data-close>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <a href="<?=site_url('site/accueil')?>" class="button">Retour à l'accueil</a>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>