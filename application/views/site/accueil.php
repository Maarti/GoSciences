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
        <p class="lead"><strong>La vie scolaire d&rsquo;un &eacute;l&egrave;ve est compos&eacute;e de plusieurs &eacute;tapes cruciales&nbsp;:</strong></p>
        <img src="<?=img_url('college.png')?>" alt="Collège" class="img-center">
        <p><strong class="green-word">En 6<sup>&egrave;me&nbsp;</sup>:</strong> Vous rentrez au coll&egrave;ge et vous &ecirc;tes soumis &agrave; un changement d&rsquo;organisation scolaire. Vous devez &ecirc;tre encadr&eacute; pour r&eacute;ussir au mieux cette ann&eacute;e charni&egrave;re.</p>
        <p><strong class="green-word">En 5<sup>&egrave;me&nbsp;</sup>:</strong> Vous entrez en cycle des approfondissements avec de nombreuses notions nouvelles. Vous devez acqu&eacute;rir les bonnes bases pour franchir au mieux ce palier.</p>
        <p><strong class="green-word">En 4<sup>&egrave;me&nbsp;</sup>:</strong> Vous commencez &agrave; aborder les programmes susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du Brevet des coll&egrave;ges. Une ma&icirc;trise de cette ann&eacute;e conditionnera la r&eacute;ussite &agrave; ce dipl&ocirc;me.</p>
        <p><strong class="green-word">En 3<sup>&egrave;me&nbsp;</sup>:</strong> Vous r&eacute;coltez les fruits de votre travail r&eacute;gulier depuis la 6<sup>&egrave;me</sup>. Vous travaillerez sur de nouvelles notions et approfondirez celles d&eacute;j&agrave; vues en 4<sup>&egrave;me</sup>. Le Dipl&ocirc;me National du Brevet validera la premi&egrave;re &eacute;tape de votre vie scolaire.</p>
        <br/>
        <img src="<?=img_url('image4.jpeg')?>" alt="Lycée" width="180px" class="img-center">
        <p><strong class="green-word">En 2<sup>nde&nbsp;</sup>:</strong> Vous entamez une vie lyc&eacute;enne totalement diff&eacute;rente de votre ancienne vie coll&eacute;gienne. De nouveaux chapitres viendront compl&eacute;ter ceux d&eacute;j&agrave; &eacute;valu&eacute;s lors du Brevet des coll&egrave;ges. Votre dernier trimestre, apr&egrave;s &eacute;valuation du conseil de classe, vous permettra de valider votre future orientation scolaire (scientifique, litt&eacute;raire, &eacute;conomique et sociale...).</p>
        <p><strong class="green-word">En 1<sup>&egrave;re&nbsp;</sup>:</strong> Vous d&eacute;butez votre sp&eacute;cialisation dans un domaine que vous appr&eacute;ciez tr&egrave;s particuli&egrave;rement. Cette ann&eacute;e est compos&eacute;e de chapitres susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du Baccalaur&eacute;at et vous devez la pr&eacute;parer dans les meilleures conditions. Vous passerez &eacute;galement les &eacute;preuves anticip&eacute;es du BAC afin d&rsquo;obtenir des points d&rsquo;avance pour les &eacute;preuves de l&rsquo;examen final.</p>
        <p><strong class="green-word">En Terminale&nbsp;:</strong> Une des ann&eacute;es les plus importantes de votre scolarit&eacute;. Vous travaillez r&eacute;guli&egrave;rement depuis la 6<sup>&egrave;me</sup> pour pr&eacute;parer cet examen qu&rsquo;est le baccalaur&eacute;at. De bonnes notes &agrave; cet examen et un tr&egrave;s bon dossier scolaire vous faciliteront l&rsquo;entr&eacute;e dans de prestigieuses &eacute;coles ou Universit&eacute;s. La derni&egrave;re ligne droite&nbsp;!</p>

        <p class="lead text-center"><strong>GoSciences vous aidera &agrave; franchir ces paliers</strong></p>
        
        <ul>
            <li><strong class="green-word">Notre zone g&eacute;ographique d&rsquo;intervention</strong></li>
        </ul>
        <p>Tous nos cours individuels ont lieu au domicile de l&rsquo;&eacute;l&egrave;ve. GoSciences se d&eacute;place sur Orl&eacute;ans et ses environs&nbsp;: La Fert&eacute;-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier. Si vous ne faites pas partie de ces communes, n&rsquo;h&eacute;sitez pas &agrave; nous contacter et nous t&acirc;cherons de r&eacute;pondre favorablement &agrave; votre demande. Nos stages collectifs de pr&eacute;paration aux examens nationaux se d&eacute;rouleront &agrave; La Fert&eacute;-Saint-Aubin sous r&eacute;serve d&rsquo;un nombre suffisant d&rsquo;&eacute;l&egrave;ve.</p>

        <ul>
            <li><strong class="green-word">Nos cours individuels</strong></li>
        </ul>
        <p>Au titre du service &agrave; la personne, vous b&eacute;n&eacute;ficiez de 50% de r&eacute;duction/cr&eacute;dit d&rsquo;imp&ocirc;t sur toutes vos d&eacute;penses*.</p>
        <p>Les frais de dossier sont d&rsquo;un montant de 49<sup>e</sup> (soit 24,5<sup>e</sup> TTC apr&egrave;s r&eacute;duction/cr&eacute;dit d&rsquo;imp&ocirc;t*) par famille et par ann&eacute;e scolaire.</p>
        <p>Nous nous engageons &agrave; vous offrir le 1<sup>er</sup> cours d&rsquo;&eacute;valuation (1 heure) de votre enfant o&ugrave; l&rsquo;enseignant prendra note de ses qualit&eacute;s et de ses points faibles afin d&rsquo;&eacute;tablir son programme scolaire personnalis&eacute;. GoSciences n&rsquo;exige aucun engagement de votre part (pas d&rsquo;heures &agrave; pr&eacute;financer) et vous propose de r&eacute;gler uniquement le nombre d&rsquo;heures effectu&eacute;es chaque mois.</p>
        <p>Tous nos enseignants sont des scientifiques de tr&egrave;s haut niveau sp&eacute;cialis&eacute;s dans un domaine pr&eacute;cis (Math&eacute;matiques, Physique, Chimie, Biologie, G&eacute;ologie&hellip;). Ils ont &eacute;t&eacute; recrut&eacute;s par nos soins apr&egrave;s consultation du C.V., mise en situation concr&egrave;te et entretien individuel. Nous exigeons par ailleurs un extrait de casier judiciaire vierge.</p>
        <p>Gosciences a mis en place une &eacute;valuation de l&rsquo;enseignant par les parents d&egrave;s le 1<sup>er</sup> cours d&rsquo;&eacute;valuation ainsi que chaque mois afin de s&rsquo;assurer de la bonne implication de son enseignant. A savoir que nous &eacute;changerons &agrave; propos de l&rsquo;&eacute;volution de l&rsquo;&eacute;l&egrave;ve lors de notre suivi p&eacute;dagogique mensuel.</p>
        <ul>
            <li><strong class="green-word">Nos stages</strong></li>
        </ul>
        <p>Les frais de dossier sont d&rsquo;un montant de 49<sup>e</sup> par famille et par ann&eacute;e scolaire si vous n&rsquo;avez pas souscrit de cours individuels au sein de GoSciences.</p>
        <p>Nous proposons trois types de stages (8h/semaine)&nbsp;:</p>
        <ol>
        <li><u>Stages de remise &agrave; niveau</u></li>
        </ol>
        <p>Ces stages ont g&eacute;n&eacute;ralement lieu durant les Grandes vacances scolaires de Juillet &agrave; Ao&ucirc;t &agrave; raison de 2 heures par jour pendant 4 jours. Il faut profiter de ce temps libre pour acqu&eacute;rir les bases et combler les lacunes accumul&eacute;es lors des classes pr&eacute;c&eacute;dentes. Ces stages ont pour but de d&eacute;marrer une nouvelle ann&eacute;e scolaire de la meilleure des mani&egrave;res.</p>
        <ol start="2">
        <li><u>Stages de perfectionnement</u></li>
        </ol>
        <p>Ces stages ont lieu durant toute l&rsquo;ann&eacute;e &agrave; raison de 2 heures par jour pendant 4 jours. Ils ont &eacute;t&eacute; con&ccedil;us pour d&eacute;velopper et optimiser les capacit&eacute;s de raisonnement d&rsquo;&eacute;l&egrave;ves poss&eacute;dant bon niveau scientifique.</p>
        <ol start="3">
        <li><u>Stages de pr&eacute;paration aux examens nationaux</u></li>
        </ol>
        <p>En 3<sup>&egrave;me</sup> et en Terminale chaque &eacute;l&egrave;ve devra se pr&eacute;senter au Brevet des coll&egrave;ges et au Baccalaur&eacute;at. Les stages se d&eacute;rouleront durant les vacances scolaires (Toussaint, No&euml;l, F&eacute;vrier et P&acirc;ques) &agrave; raison de 2 heures par jour pendant 4 jours pour les &eacute;l&egrave;ves de 3<sup>&egrave;me</sup> et 4 heures par jour pendant 2 jours pour les &eacute;l&egrave;ves de&nbsp;Terminale pour pr&eacute;parer au mien leurs examens respectifs. Ils effectueront avec l&rsquo;enseignant uniquement des exercices de pr&eacute;c&eacute;dentes &eacute;ditions du Brevet des coll&egrave;ges et du Baccalaur&eacute;at. Il veillera attentivement &agrave; leurs raisonnements ainsi qu&rsquo;&agrave; leurs fautes d&rsquo;inattention.</p>
        <ul>
        <li><strong class="green-word">Paiement</strong></li>
        </ul>
        <p>GoSciences accepte les moyens de paiement suivant&nbsp;:</p>
        <ul>
        <li>Ch&egrave;ques</li>
        <li>Esp&egrave;ces</li>
        <li>Ch&egrave;ques Emploi Service Universel</li>
        <li>Virement bancaire</li>
        </ul>
        <p>Les ch&egrave;ques et les esp&egrave;ces seront directement libell&eacute;s &agrave; l&rsquo;adresse de notre si&egrave;ge social situ&eacute; &agrave; la Fert&eacute;-Saint-Aubin.</p>
        <br>
        <p>*<em>Selon </em><em>&nbsp;les conditions pos&eacute;es par l&rsquo;art. 199 sexdecies du CGI, sous r&eacute;serve de modification de la l&eacute;gislation.</em></p>

      </div>
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>