<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer>
    <div class="row expanded callout secondary">
        <div class="small-6 large-3 columns">
            <p class="lead">Offices</p>
            <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
                <li><a href="#">Four</a></li>
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Partenaires</p>
            <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
                <li><a href="#">Four</a></li>
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Contact</p>
            <ul class="menu vertical">
                <li><a href="#"><i class="fi-social-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fi-social-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fi-social-instagram"></i> Instagram</a></li>
                <li><a href="#"><i class="fi-social-pinterest"></i> Pinterest</a></li>
            </ul>
        </div>
        <div class="small-6 large-3 columns">
            <p class="lead">Offices</p>
            <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
                <li><a href="#">Four</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="medium-6 columns" id="author">
            Développé par <a href="http://bryan.maarti.net/?lang=fr" target="_blank">Bryan MARTINET</a>
            <!--<ul class="menu">
                <li><a href="#">Mentions Légales</a></li>
                <li><a href="#">Partenaires</a></li>
                <li><a href="<?= site_url('site/contact') ?>">Contact</a></li>
            </ul>-->
        </div>
        <div class="medium-6 columns">
            <ul class="menu float-right">
                <li class="menu-text">Copyright &copy; 2017 GoSciences</li>
            </ul>
        </div>
    </div>
</footer>

<script src="<?= js_url('vendor/jquery.min') ?>"></script>
<script src="<?= js_url('vendor/what-input.min') ?>"></script>
<script src="<?= js_url('foundation.min') ?>"></script>
<script>
    $(document).foundation();
</script>
<? // Permet l'ouverture automatique d'un modal au chargement de la page
    if(isset($show_modal))
        echo '<script>$(document).ready(function(){$(\'#'.$show_modal.'\').foundation(\'open\')});</script>'
?>
</body>
</html>