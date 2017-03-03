<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu data-close-on-click-inside="false">
      <!--<li class="menu-text">GoSciences</li>-->
      <li>
        <a href="<?= site_url('site/accueil')?>">GoSciences</a>
        <ul class="menu vertical">
          <li><a href="<?= site_url('site/accueil')?>">Nos valeurs</a></li>         
          <li><a href="<?= site_url('site/accueil')?>">L'&eacute;quipe</a></li>          
          <li><a href="<?= site_url('site/contact')?>">Contact</a></li>
        </ul>
      </li>
      <li>
      <a href="#">Nos cours</a>
       <ul class="menu vertical">
        <li>
        <a href="<?= site_url('site/accueil')?>">Coll&egrave;ge</a>
        <ul class="menu">
          <li><a href="<?= site_url('site/accueil')?>">Mathématiques</a></li>
          <li><a href="<?= site_url('site/accueil')?>">Physique</a></li>
          <li><a href="<?= site_url('site/accueil')?>">Chimie</a></li>
          <li><a href="<?= site_url('site/accueil')?>">SVT</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= site_url('site/accueil')?>">Lyc&eacute;e</a>
        <ul class="menu">
          <li><a href="<?= site_url('site/accueil')?>">Mathématiques</a></li>
          <li><a href="<?= site_url('site/accueil')?>">Physique</a></li>
          <li><a href="<?= site_url('site/accueil')?>">Chimie</a></li>
          <li><a href="<?= site_url('site/accueil')?>">SVT</a></li>
        </ul>
      </li> 
     </ul>
     </li>
     <li><a href="<?= site_url('cours/tarifs')?>">Tarifs</a></li>          
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="dropdown menu" data-dropdown-menu data-close-on-click-inside="false">
      <? if(isset($_SESSION['id']) && in_array(90, $_SESSION['roles'])){?>
        <li class="active"><a href="<?= site_url('admin')?>">Administration</a></li>
      <? } ?>
      <li>
        <a href="<?= site_url('utilisateur/connexion')?>">Espace Client</a>
        <ul class="menu vertical">
          <? if(isset($_SESSION['id'])){ ?>
            <li><a href="<?= site_url('utilisateur/mon_compte')?>">Mon compte</a></li>
            <li><a href="<?= site_url('utilisateur/deconnexion')?>">Déconnexion</a></li>
          <? }else{ ?>
            <li><a href="<?= site_url('utilisateur/inscription')?>">Inscription</a></li>         
            <li><a href="<?= site_url('utilisateur/connexion')?>">Connexion</a></li>
          <? } ?>
        </ul>
      </li>
    </ul>
  </div>
</div>