<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$classes = $this->classe_model->get_array();
$prestations = $this->classe_model->get_prestations();?>
<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu data-close-on-click-inside="false">
      <!--<li class="menu-text">GoSciences</li>-->
      <li>
        <a href="<?= site_url('site/accueil')?>">GoSciences</a>
        <ul class="menu vertical">
          <li><a href="<?= site_url('site/valeurs')?>">Nos Valeurs</a></li>         
          <li><a href="<?= site_url('site/equipe')?>">Notre &Eacute;quipe</a></li>          
          <li><a href="<?= site_url('site/contact')?>">Nous Contacter</a></li>
        </ul>
      </li>
      <li>
      <a href="#">Nos Offres</a>
       <ul class="menu vertical">
           <? foreach ($classes as $etab) {?>
           <li>     
           <a href="<?= site_url('classe/infos')?>"><?=$etab['libelle']?></a>
           <ul class="menu">
               <? foreach ($etab['classes'] as $classe) { ?>
               <li><a href="<?= site_url('classe/infos/'.$classe['id'])?>"><?=$classe['libelle']?></a></li>
                <?}?>
           </ul></li>
           <?}?>       
     </ul>
     </li>
     <li><a href="<?= site_url('cours/tarifs')?>">Tarifs</a>
        <ul class="menu vertical">
           <? foreach ($prestations as $prest) {?>
            <li><a href="<?= site_url('cours/tarifs/'.$prest['id'])?>"><?=$prest['libelle']?></a></li>
           <?}?>
        </ul>
     </li>          
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="dropdown menu" data-dropdown-menu data-close-on-click-inside="false">
      <? if(isset($_SESSION['id']) && in_array(90, $_SESSION['roles'])){?>
        <li class="active"><a href="<?= site_url('admin')?>">Admin</a></li>
      <? } ?>
      <li>
        <a href="<?= site_url('utilisateur')?>">Mon Espace</a>
        <ul class="menu vertical">
          <? if(isset($_SESSION['id'])){ ?>
            <li><a href="<?= site_url('utilisateur/infos')?>"><i class="fi-torso"></i> Mon compte</a></li>
            <li><a href="<?= site_url('')?>"><i class="fi-clipboard-notes"></i> Mes cours</a></li>
            <li><a href="<?= site_url('')?>"><i class="fi-clipboard-pencil"></i> Réserver</a></li>
            <li><a href="<?= site_url('utilisateur/deconnexion')?>"><i class="fi-x"></i> Déconnexion</a></li>
          <? }else{ ?>
            <li><a href="<?= site_url('utilisateur/inscription')?>"><i class="fi-clipboard-pencil"></i> Inscription</a></li>         
            <li><a href="<?= site_url('utilisateur/connexion')?>"><i class="fi-torso"></i> Connexion</a></li>
          <? } ?>
        </ul>
      </li>
    </ul>
  </div>
</div>