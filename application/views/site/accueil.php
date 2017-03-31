<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">

        <? $this->load->view('include/homepagetitle'); ?>

        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
        <ul class="orbit-container">
          <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
          <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
          <li class="is-active orbit-slide">
            <img class="orbit-image" src="<?=img_url('image1.jpeg')?>" alt="Eleve tableau">
            <figcaption class="orbit-caption">L'art de la réussite consiste à savoir s'entourer des meilleurs</figcaption>
          </li>
          <li class="orbit-slide">
            <img class="orbit-image" src="<?=img_url('image2.jpeg')?>" alt="Photo remise de prix">
            <figcaption class="orbit-caption">Prix de la Fondation de l'Université d'Orléans niveau Master remis à Sulayman Benmerzoug</figcaption>
          </li>          
        </ul>
        <nav class="orbit-bullets">
          <button class="is-active" data-slide="0"><span class="show-for-sr">L'art de la réussite consiste à savoir s'entourer des meilleurs</span><span class="show-for-sr">Current Slide</span></button>
          <button data-slide="1"><span class="show-for-sr">Prix de la Fondation de l'Université d'Orléans niveau Master remis à Sulayman Benmerzoug</span></button>
        </nav>
      </div>
       
 
      <div class="text-justify">
        <p class="lead"><strong>La vie scolaire d&rsquo;un &eacute;l&egrave;ve est compos&eacute;e de plusieurs &eacute;tapes cruciales</strong></p>
        <img src="<?=img_url('college.png')?>" alt="Collège" class="img-center">
        <br>
        <?=display('accueil');?>
        <img src="<?=img_url('image4.jpeg')?>" alt="Lycée" width="180" class="img-center">
        <?=display('accueil_2');?>
      </div>
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>