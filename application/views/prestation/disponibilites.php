<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <nav aria-label="Vous êtes ici :" role="navigation">
          <ul class="breadcrumbs">
            <li>Définir la prestation</li>
            <li>
                <span class="show-for-sr">Actuellement : </span><strong class="green-word">Définir vos disponibilités</strong></li>
            <li>Proposition de cours</li>
            <li>Validation</li>    
          </ul>
        </nav>
        <br/>
        
        <div class="callout secondary">
            <?//=display('contact_recrutement')?>
            <p>Indiquez les disponibilités de l'élève en sélectionnant les créneaux horaires sur le calendrier ci dessous.</p>
            <p>Nous vous proposerons ensuite des prestations parmi les tranches horaires sélectionnées.</p>
        </div>
        
        <?= form_open('prestation/valid_disponibilites/'.$prestation->id,'data-abide'); ?>
        <!--
        <div id="dispo-container">
            <div class="row">
              <div class="small-4 columns">
                <label>Date :
                  <input type="date" placeholder="2017-01-30">
                </label>
              </div>
              <div class="small-4 columns">
                <label>Heure début :
                  <input type="text" class="timepicker" placeholder="17:30">
                </label>
              </div>
                <div class="small-4 columns">
                <label>Heure fin :
                  <input type="text" class="timepicker" placeholder="20:00">
                </label>
              </div>
            </div>
        </div>
        <button class="button" type="button" id="new-creneau">Ajouter un créneau</button>
        -->
        <?= form_error('disponibilite'); ?>
        <div id='calendar'></div>
        <input type="hidden" id="disponibilite" name="disponibilite" value='{"events":[]}'>
        <br/>
        
        <label>Commentaire (optionnel)
            <textarea name="commentaire" placeholder="Faites-nous part de vos remarques concernant vos disponibilités" rows="3" maxlength="512"><?= set_value('commentaire')?></textarea>
            <?= form_error('commentaire'); ?>
        </label>
        
        <br/>
        <div class="clearfix">
            <div class="float-right">
                <input type="submit" class="button large" id="valid-dispo" value="Proposer ces horaires">
            </div>
        </div>
        </form>
        <br/><br/>
    </div>

    <? $this->load->view('include/sidebar'); ?>
</div>