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
        
        <?= form_open('prestation/valid_reserver','data-abide'); ?>
        
        <div class="row">
          <div class="small-4 columns">
            <label>Date :
              <input type="date">
            </label>
          </div>
          <div class="small-4 columns">
            <label>Heure début :
              <input type="time" placeholder="18:30">
            </label>
          </div>
            <div class="small-4 columns">
            <label>Heure fin :
              <input type="time">
            </label>
          </div>
        </div>
        <button class="button">Ajouter un créneau</button>
        
        </form>
        
    </div>
    
    <? $this->load->view('include/sidebar'); ?>
</div>