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
        <p class="lead green-word"><strong>La vie scolaire d&rsquo;un &eacute;l&egrave;ve est compos&eacute;e de plusieurs &eacute;tapes cruciales&nbsp;:</strong></p>
        <img src="<?=img_url('image3.jpeg')?>" alt="Collège" class="img-center">
        <p><strong class="green-word">En 6<sup>&egrave;me&nbsp;</sup>:</strong> Vous rentrez au coll&egrave;ge et vous &ecirc;tes soumis &agrave; un changement d&rsquo;organisation scolaire. Vous devez &ecirc;tre encadr&eacute; pour r&eacute;ussir au mieux cette ann&eacute;e charni&egrave;re.</p>
        <p><strong class="green-word">En 5<sup>&egrave;me&nbsp;</sup>:</strong> Vous entrez en cycle des approfondissements avec de nombreuses notions nouvelles. Vous devez acqu&eacute;rir les bonnes bases pour franchir au mieux ce palier.</p>
        <p><strong class="green-word">En 4<sup>&egrave;me&nbsp;</sup>:</strong> Vous commencez &agrave; aborder les programmes susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du Brevet des coll&egrave;ges. Une ma&icirc;trise de cette ann&eacute;e conditionnera la r&eacute;ussite &agrave; ce dipl&ocirc;me.</p>
        <p><strong class="green-word">En 3<sup>&egrave;me&nbsp;</sup>:</strong> Vous r&eacute;coltez les fruits de votre travail r&eacute;gulier depuis la 6<sup>&egrave;me</sup>. Vous travaillerez sur de nouvelles notions et approfondirez celles d&eacute;j&agrave; vues en 4<sup>&egrave;me</sup>. Le Dipl&ocirc;me National du Brevet validera la premi&egrave;re &eacute;tape de votre vie scolaire.</p>
        <br/>
        <img src="<?=img_url('image4.jpeg')?>" alt="Lycée" class="img-center">
        <p><strong class="green-word">En 2<sup>nde&nbsp;</sup>:</strong> Vous entamez une vie lyc&eacute;enne totalement diff&eacute;rente de votre ancienne vie coll&eacute;gienne. De nouveaux chapitres viendront compl&eacute;ter ceux d&eacute;j&agrave; &eacute;valu&eacute;s lors du Brevet des coll&egrave;ges. Votre dernier trimestre, apr&egrave;s &eacute;valuation du conseil de classe, vous permettra de valider votre future orientation scolaire (scientifique, litt&eacute;raire, &eacute;conomique et sociale...).</p>
        <p><strong class="green-word">En 1<sup>&egrave;re&nbsp;</sup>:</strong> Vous d&eacute;butez votre sp&eacute;cialisation dans un domaine que vous appr&eacute;ciez tr&egrave;s particuli&egrave;rement. Cette ann&eacute;e est compos&eacute;e de chapitres susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du Baccalaur&eacute;at et vous devez la pr&eacute;parer dans les meilleures conditions. Vous passerez &eacute;galement les &eacute;preuves anticip&eacute;es du BAC afin d&rsquo;obtenir des points d&rsquo;avance pour les &eacute;preuves de l&rsquo;examen final.</p>
        <p><strong class="green-word">En Terminale&nbsp;:</strong> Une des ann&eacute;es les plus importantes de votre scolarit&eacute;. Vous travaillez r&eacute;guli&egrave;rement depuis la 6<sup>&egrave;me</sup> pour pr&eacute;parer cet examen qu&rsquo;est le baccalaur&eacute;at. De bonnes notes &agrave; cet examen et un tr&egrave;s bon dossier scolaire vous faciliteront l&rsquo;entr&eacute;e dans de prestigieuses &eacute;coles ou Universit&eacute;s. La derni&egrave;re ligne droite&nbsp;!</p>

        <p class="lead text-center"><strong class="green-word">GoSciences vous aidera &agrave; franchir ces paliers</strong></p>
      </div>
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>