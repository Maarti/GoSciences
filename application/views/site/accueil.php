<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">

        <? $this->load->view('include/homepagetitle'); ?>

        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
        <ul class="orbit-container">
          <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
          <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
          <li class="is-active orbit-slide">
            <img class="orbit-image" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/01.jpg" alt="Space">
            <figcaption class="orbit-caption">Space, the final frontier.</figcaption>
          </li>
          <li class="orbit-slide">
            <img class="orbit-image" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/02.jpg" alt="Space">
            <figcaption class="orbit-caption">Lets Rocket!</figcaption>
          </li>
          <li class="orbit-slide">
            <img class="orbit-image" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/03.jpg" alt="Space">
            <figcaption class="orbit-caption">Encapsulating</figcaption>
          </li>
          <li class="orbit-slide">
            <img class="orbit-image" src="http://foundation.zurb.com/sites/docs/assets/img/orbit/04.jpg" alt="Space">
            <figcaption class="orbit-caption">Outta This World</figcaption>
          </li>
        </ul>
        <nav class="orbit-bullets">
          <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
          <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
          <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
          <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
        </nav>
      </div>
  
        <p class="lead">Hac ita persuasione reducti intra moenia bellatores obseratis undique portarum aditibus, propugnaculis insistebant et pinnis, congesta undique saxa telaque habentes in promptu, ut si quis se proripuisset interius, multitudine missilium sterneretur et lapidum.</p>
        <p>Hacque adfabilitate confisus cum eadem postridie feceris, ut incognitus haerebis et repentinus, hortatore illo hesterno clientes numerando, qui sis vel unde venias diutius ambigente agnitus vero tandem et adscitus in amicitiam si te salutandi adsiduitati dederis triennio indiscretus et per tot dierum defueris tempus, reverteris ad paria perferenda, nec ubi esses interrogatus et quo tandem miser discesseris, aetatem omnem frustra in stipite conteres summittendo.</p>

    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>