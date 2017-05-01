<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 columns">
        <? $this->load->view('include/admin_menu'); ?>

        <br/>
        
        <div class="callout secondary">
            <p>Proposez des cours en fonction de la demande de prestation du client.</p>
        </div>
        
        <h2> Rappel de la demande :</h2>
        <div class="row small-uncollapse">
            <div class="small-12 medium-6 columns">
                <table>
                    <tr><td width="140">Parent :</td><td><?=$prestation->civilite?> <?=$prestation->nom_parent?> <?=$prestation->prenom_parent?></td></tr>
                    <tr><td>Élève :</td><td><?=$prestation->nom_eleve?> <?=$prestation->prenom_eleve?></td></tr>
                    <tr><td>Classe :</td><td><?=$prestation->classe_libel?></td></tr>
                    <tr><td>Mail :</td><td><?=$prestation->mail?></td></tr>
                    <tr><td>Tel :</td><td><?=$this->format_string->format_tel($prestation->tel)?></td></tr>
                    <tr><td>Code Postal :</td><td><?=$prestation->cp?></td></tr>
                    <tr><td>Ville :</td><td><?=$prestation->ville?></td></tr>
                    <tr><td>Adresse :</td><td><?=$prestation->adresse?></td></tr>
                </table>
            </div>
            <div class="small-12 medium-6 columns">
                <table>
                    <tr><td width="140">Date création :</td><td><?=$prestation->date_creation?></td></tr>
                    <tr><td>État :</td><td><?=$prestation->etat?></td></tr>
                    <tr><td>Type prestation :</td><td><?=$prestation->prest_libel?></td></tr>
                    <tr><td>Nb heures :</td><td><?=$prestation->nb_heure?></td></tr>
                    <tr><td>Disciplines :</td><td><?=  implode(", ",unserialize($prestation->disciplines)) ?></td></tr>
                </table>
                <label>Commentaire client :
                    <textarea name="commentaire" placeholder="Aucun" rows="3" readonly><?=$prestation->commentaire?></textarea>            
                </label>
            </div>            
        </div>
        
        
        <label>Disponibilités de l'élève :</label>
        <div id='calendar'></div>        
        <br>
        
        <hr>
        <h2>Faire une proposition :</h2>
        <?//= form_open('admin/valid_faire_proposition/'.$prestation->id,'data-abide'); ?>

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
                <input type="submit" class="button large disabled" id="valid-dispo" value="Confirmer cette proposition">
            </div>
        </div>
        </form>
        <br/><br/>
    </div>

</div>