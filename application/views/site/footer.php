<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer>
    <div class="row expanded callout secondary">
        <div class="small-6 large-3 columns">
            <p class="lead">Site</p>
            <ul class="menu vertical">
                <li><a href="<?=site_url('site/accueil')?>">Accueil</a></li>
                <li><a href="<?=site_url('site/valeurs')?>">Nos Valeurs</a></li>
                <li><a href="<?=site_url('site/equipe')?>">Notre Équipe</a></li>
                <li><a href="<?=site_url('classe/infos')?>">Offres</a></li>
                <li><a href="<?=site_url('cours/tarifs')?>">Tarifs</a></li>                
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Professeurs</p>
            <ul class="menu vertical">
                <li><a href="<?=site_url('site/contact?contact=email&motif=postuler')?>"><i class="fi-megaphone"></i> Recrutement</a></li>
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Contact</p>
            <ul class="menu vertical">
                <li><a href="<?=site_url('site/contact?contact=telephone')?>"><i class="fi-telephone"></i> Téléphone</a></li>
                <li><a href="<?=site_url('site/contact?contact=email&motif=info')?>"><i class="fi-mail"></i> E-mail</a></li>
                <li><a href="https://www.facebook.com/soutienscolairedexcellence/" target="_blank"><i class="fi-social-facebook"></i> Facebook</a></li>
                <!--<li><a href="#"><i class="fi-social-twitter"></i> Twitter</a></li>-->
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Légal</p>
            <ul class="menu vertical">
                <li><a href="#">Mentions Légales</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="medium-6 columns" id="author">
            Développé par <a href="http://bryan.maarti.net/?lang=fr" target="_blank">Bryan MARTINET</a>
        </div>
        <div class="medium-6 columns">
            <ul class="menu float-right">
                <li class="menu-text">Copyright &copy; 2017 GoSciences</li>
            </ul>
        </div>
    </div>
</footer>
<div id="fb-root"></div>

<script src="<?= js_url('vendor/jquery.min') ?>"></script>
<script src="<?= js_url('vendor/what-input.min') ?>"></script>
<script src="<?= js_url('foundation.min') ?>"></script>
<script>
    $(document).foundation();
</script>
<? // Permet l'ouverture automatique d'un modal au chargement de la page
   /* if(isset($show_modal))
        echo '<script>$(document).ready(function(){$(\'#'.$show_modal.'\').foundation(\'open\')});</script>'*/
?>
<? if(isset($footer_include))
     foreach ($footer_include as $script) {?>
        <?=$script?>

     <?}?>
<script src="<?= js_url('scripts/facebook') ?>"></script>
</body>
</html>