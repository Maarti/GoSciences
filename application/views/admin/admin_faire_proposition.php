<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
        <? $this->load->view('include/admin_menu'); ?>

        <br/>
        
        <div class="callout secondary">
            <p>Proposez des cours en fonction de la demande de prestation du client.</p>
        </div>
        
        <h2> Rappel de la demande :</h2>
        <div id='calendar'></div>
        
        <label>Commentaire client :
            <textarea name="commentaire" placeholder="Aucun" rows="3" readonly><?=$prestation->commentaire?></textarea>            
        </label><br>
        <hr>
        <h2>Faire une proposition :</h2>
        <?= form_open('admin/valid_faire_proposition/'.$prestation->id,'data-abide'); ?>

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
  
        
        <br/>
        <div class="clearfix">
            <div class="float-right">
                <input type="submit" class="button large" id="valid-dispo" value="Confirmer cette proposition">
            </div>
        </div>
        </form>
        <br/><br/>
    </div>

</div>