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
        <!--
        <p><strong class="green-word">En 6<sup>&egrave;me&nbsp;</sup>:</strong> Vous rentrez au coll&egrave;ge et vous &ecirc;tes soumis &agrave; un <strong>changement d&rsquo;organisation scolaire</strong>. Vous devez &ecirc;tre encadr&eacute; pour r&eacute;ussir au mieux cette ann&eacute;e charni&egrave;re.</p>
        <p><strong class="green-word">En 5<sup>&egrave;me&nbsp;</sup>:</strong> Vous entrez en cycle des approfondissements avec de <strong>nombreuses notions nouvelles</strong>. Vous devez acqu&eacute;rir les <strong>bonnes bases</strong> pour franchir au mieux ce palier.</p>
        <p><strong class="green-word">En 4<sup>&egrave;me&nbsp;</sup>:</strong> Vous commencez &agrave; aborder les programmes susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du <strong>Brevet des coll&egrave;ges</strong>. Une ma&icirc;trise de cette ann&eacute;e conditionnera la <strong>r&eacute;ussite</strong> &agrave; ce dipl&ocirc;me.</p>
        <p><strong class="green-word">En 3<sup>&egrave;me&nbsp;</sup>:</strong> Vous r&eacute;coltez les fruits de <strong>votre travail r&eacute;gulier</strong> depuis la 6<sup>&egrave;me</sup>. Vous travaillerez sur de <strong>nouvelles notions</strong> et <strong>approfondirez</strong> celles d&eacute;j&agrave; vues en <strong>4<sup>&egrave;me</sup></strong>. <strong>Le Dipl&ocirc;me National du Brevet</strong> validera la premi&egrave;re &eacute;tape de votre vie scolaire.</p>
        <br/>-->
        <img src="<?=img_url('image4.jpeg')?>" alt="Lycée" width="180px" class="img-center">
        <?=display('accueil_2');?><!--
        <p><strong class="green-word">En 2<sup>nde&nbsp;</sup>:</strong> Vous entamez une <strong>vie lyc&eacute;enne</strong> totalement diff&eacute;rente de votre ancienne vie coll&eacute;gienne. De <strong>nouveaux chapitres</strong> viendront compl&eacute;ter ceux d&eacute;j&agrave; &eacute;valu&eacute;s lors du Brevet des coll&egrave;ges. Votre dernier trimestre, apr&egrave;s &eacute;valuation du conseil de classe, vous permettra de <strong>valider votre future orientation scolaire</strong> (scientifique, litt&eacute;raire, &eacute;conomique et sociale...).</p>
        <p><strong class="green-word">En 1<sup>&egrave;re&nbsp;</sup>:</strong> Vous d&eacute;butez votre <strong>sp&eacute;cialisation</strong> dans un domaine que vous appr&eacute;ciez tr&egrave;s particuli&egrave;rement. Cette ann&eacute;e est compos&eacute;e de <strong>chapitres susceptibles d&rsquo;&ecirc;tre &eacute;valu&eacute;s lors du Baccalaur&eacute;at</strong> et vous devez la pr&eacute;parer dans les <strong>meilleures conditions</strong>. Vous passerez &eacute;galement les <strong>&eacute;preuves anticip&eacute;es du BAC</strong> afin d&rsquo;obtenir des <strong>points d&rsquo;avance</strong> pour les &eacute;preuves de l&rsquo;examen final.</p>
        <p><strong class="green-word">En Terminale&nbsp;:</strong> Une des ann&eacute;es les plus <strong>importantes</strong> de votre scolarit&eacute;. Vous travaillez r&eacute;guli&egrave;rement depuis la 6<sup>&egrave;me</sup> pour pr&eacute;parer cet examen qu&rsquo;est le <strong>baccalaur&eacute;at</strong>. De <strong>bonnes notes</strong> &agrave; cet examen et un <strong>tr&egrave;s bon dossier scolaire</strong> vous faciliteront l&rsquo;entr&eacute;e dans de <strong>prestigieuses &eacute;coles</strong> ou <strong>Universit&eacute;s</strong>. La derni&egrave;re ligne droite&nbsp;!</p>

        <p class="lead text-center"><strong>GoSciences vous aidera &agrave; franchir ces paliers</strong></p>
        
        <ul><li><strong class="green-word">Notre zone g&eacute;ographique d&rsquo;intervention</strong></li></ul>
        <p>Tous nos cours individuels ont lieu au <strong>domicile de l&rsquo;&eacute;l&egrave;ve</strong>. GoSciences se d&eacute;place sur <strong>Orl&eacute;ans et ses environs</strong>&nbsp;: La Fert&eacute;-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier. Si vous ne faites pas partie de ces communes, n&rsquo;h&eacute;sitez pas &agrave; nous contacter et nous t&acirc;cherons de r&eacute;pondre <strong>favorablement</strong> &agrave; votre demande. Nos <strong>stages collectifs</strong> de pr&eacute;paration aux examens nationaux se d&eacute;rouleront &agrave; <strong>La Fert&eacute;-Saint-Aubin</strong> sous r&eacute;serve d&rsquo;un nombre suffisant d&rsquo;&eacute;l&egrave;ve.</p>

        <ul><li><strong class="green-word">Nos cours individuels</strong></li></ul>
        <p>Au titre du service &agrave; la personne, vous b&eacute;n&eacute;ficiez de <strong>50% de r&eacute;duction/cr&eacute;dit d&rsquo;imp&ocirc;t sur toutes vos d&eacute;penses</strong>*.</p>
        <p>Les frais de dossier sont d&rsquo;un montant de <strong>49€</strong> (soit <strong>24,5€ TTC apr&egrave;s r&eacute;duction/cr&eacute;dit d&rsquo;imp&ocirc;t</strong>*) par <strong>famille </strong>et par <strong>ann&eacute;e scolaire</strong>.</p>
        <p>Nous nous engageons &agrave; vous <strong>offrir le 1<sup>er</sup> cours d&rsquo;&eacute;valuation</strong> (1 heure) de votre enfant o&ugrave; l&rsquo;enseignant prendra note de ses qualit&eacute;s et de ses points faibles afin d&rsquo;&eacute;tablir <strong>son programme scolaire personnalis&eacute;</strong>. GoSciences n&rsquo;exige <strong>aucun engagement</strong> de votre part (<strong>pas d&rsquo;heures &agrave; pr&eacute;financer</strong>) et vous propose de r&eacute;gler uniquement le <strong>nombre d&rsquo;heures effectu&eacute;es chaque mois</strong>.</p>
        <p>Tous nos enseignants sont des <strong>scientifiques de tr&egrave;s haut niveau</strong> sp&eacute;cialis&eacute;s dans un domaine pr&eacute;cis (Math&eacute;matiques, Physique, Chimie, Biologie, G&eacute;ologie&hellip;). Ils ont &eacute;t&eacute; recrut&eacute;s par nos soins apr&egrave;s consultation du <strong>C.V.</strong>, <strong>mise en situation</strong> concr&egrave;te et <strong>entretien individuel</strong>. Nous exigeons par ailleurs un extrait de <strong>casier judiciaire vierge</strong>.</p>
        <p>Gosciences a mis en place <strong>une &eacute;valuation de l&rsquo;enseignant par les parents</strong> d&egrave;s le 1<sup>er</sup> cours d&rsquo;&eacute;valuation ainsi que chaque mois afin de s&rsquo;assurer de la <strong>bonne implication</strong> de son enseignant. A savoir que nous &eacute;changerons &agrave; propos de l&rsquo;&eacute;volution de l&rsquo;&eacute;l&egrave;ve lors de notre <strong>suivi p&eacute;dagogique mensuel</strong>.</p>

        <ul><li><strong class="green-word">Nos stages</strong></li></ul>
        <p>Les frais de dossier sont d&rsquo;un montant de 49€ par famille et par ann&eacute;e scolaire <strong>si vous n&rsquo;avez pas souscrit de cours individuels au sein de GoSciences</strong>.</p>
        <p>Nous proposons trois types de stages (8h/semaine)&nbsp;:</p>

        <ol><li><u>Stages de remise &agrave; niveau</u></li></ol>
        <p>Ces stages ont g&eacute;n&eacute;ralement lieu durant les <strong>Grandes vacances scolaires</strong> de Juillet &agrave; Ao&ucirc;t &agrave; raison de 2 heures par jour pendant 4 jours. Il faut profiter de ce temps libre pour <strong>acqu&eacute;rir les bases</strong> et <strong>combler les lacunes</strong> accumul&eacute;es lors des classes pr&eacute;c&eacute;dentes. Ces stages ont pour but de d&eacute;marrer une nouvelle ann&eacute;e scolaire de la <strong>meilleure des mani&egrave;res</strong>.</p>

        <ol start="2"><li><u>Stages de perfectionnement</u></li></ol>
        <p>Ces stages ont lieu durant toute l&rsquo;ann&eacute;e &agrave; raison de 2 heures par jour pendant 4 jours. Ils ont &eacute;t&eacute; con&ccedil;us pour <strong>d&eacute;velopper</strong> et <strong>optimiser</strong> les capacit&eacute;s de <strong>raisonnement</strong> d&rsquo;&eacute;l&egrave;ves poss&eacute;dant bon niveau scientifique.</p>

        <ol start="3"><li><u>Stages de pr&eacute;paration aux examens nationaux</u></li></ol>
        <p>En 3<sup>&egrave;me</sup> et en Terminale chaque &eacute;l&egrave;ve devra se pr&eacute;senter au <strong>Brevet des coll&egrave;ges</strong> et au <strong>baccalaur&eacute;at</strong>. Les stages se d&eacute;rouleront durant les <strong>vacances scolaires</strong> (Toussaint, No&euml;l, F&eacute;vrier et P&acirc;ques) &agrave; raison de 2 heures par jour pendant 4 jours pour les &eacute;l&egrave;ves de 3<sup>&egrave;me</sup> et 4 heures par jour pendant 2 jours pour les &eacute;l&egrave;ves de&nbsp;Terminale pour <strong>pr&eacute;parer au mieux leurs examens</strong> respectifs. Ils effectueront avec l&rsquo;enseignant uniquement des <strong>exercices</strong> de pr&eacute;c&eacute;dentes &eacute;ditions du Brevet des coll&egrave;ges et du Baccalaur&eacute;at. Il veillera attentivement &agrave; leurs <strong>raisonnements</strong> ainsi qu&rsquo;&agrave; leurs <strong>fautes d&rsquo;inattention</strong>.</p>

        <ul><li><strong class="green-word">Paiement</strong></li></ul>
        <p>GoSciences accepte les moyens de paiement suivant&nbsp;:</p>
        <ul>
            <li>Ch&egrave;ques</li>
            <li>Esp&egrave;ces</li>
            <li>Ch&egrave;ques Emploi Service Universel</li>
            <li>Virement bancaire</li>
        </ul>
        <p>Les ch&egrave;ques et les esp&egrave;ces seront directement libell&eacute;s &agrave; l&rsquo;adresse de notre si&egrave;ge social situ&eacute; &agrave; la Fert&eacute;-Saint-Aubin.</p>
        <br>
        <p>*<em class="text-80">Selon les conditions pos&eacute;es par l&rsquo;art. 199 sexdecies du CGI, sous r&eacute;serve de modification de la l&eacute;gislation.</em></p>
-->
      </div>
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>