<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <div class="row text-center" data-equalizer data-equalize-on="medium">
            
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('utilisateur/infos')?>" class="button large expanded gosciences-green">Mon Compte</a>
                    <p>Modifiez vos informations personnelles.</p>
                </div>
            </div>
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('')?>" class="button large expanded gosciences-green disabled">Mes cours</a>
                    <p>Consultez les cours particuliers, aides aux devoirs et stages auxquels vous êtes inscrit.</p>
                </div>
            </div>
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('')?>" class="button large expanded gosciences-green disabled">S'inscrire à une prestation</a>
                    <p>Réserver dès maintenant votre prochaine prestation. Consultez les horaires possibles, proposez vos créneaux de disponibilité.</p>
                </div>
            </div>
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('site/contact')?>" class="button large expanded gosciences-green">Demande d'information</a>
                    <p>Une interrogation ? Une demande spécifique ? N'hésitez pas à nous contacter !</p>
                </div>
            </div>
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('site/postuler')?>" class="button large expanded gosciences-green disabled">Devenir professeur</a>
                    <p>Vous souhaitez intégrer GoSciences en tant que professeur particulier ? Vous pouvez postuler via notre formulaire pour un premier contact.</p>
                </div>
            </div>
            <div class="small-12 medium-6 large-4 columns">
                <div class="tile" data-equalizer-watch>
                    <a href="<?=site_url('utilisateur/deconnexion')?>" class="button large expanded gosciences-green">Déconnexion</a>
                    <p>Fermez votre session manuellement si vous êtes sur une machine publique.</p>
                </div>
            </div>
            
            <? if(isset($_SESSION['id']) && in_array(90, $_SESSION['roles'])){?>
                <div class="small-12 medium-6 large-4 columns">
                    <div class="tile" data-equalizer-watch>
                        <a href="<?=site_url('admin')?>" class="button large expanded">Administration</a>
                        <p>Administration du site.</p>
                    </div>
                </div>
            <? } ?>
        </div>
        <br/>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>