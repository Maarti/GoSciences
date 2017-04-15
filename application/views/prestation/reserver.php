<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <nav aria-label="Vous êtes ici :" role="navigation">
          <ul class="breadcrumbs">
            <li>
                <span class="show-for-sr">Actuellement : </span><strong class="green-word">Définir la prestation</strong>
            </li>
            <li>Définir vos disponibilités</li>
            <li>Proposition de cours</li>
            <li>Validation</li>    
          </ul>
        </nav>
        <br/>
        
        <?= form_open('prestation/valid_reserver','data-abide'); ?>
        <label>Élève concerné(e) :
        <?if(!empty($eleves)){?>
            <select name="eleve" id="eleve">
            <? foreach ($eleves as $e) {?>
                <option value="<?=$e->id?>" <?=set_select('eleve', $e->id)?> data-eleve-classe="<?=$e->classe?>"><?=$e->nom?> <?=$e->prenom?></option>                 
            <?}?>
            </select>                        
        <?}else{?>
            <br/><i class="fi-info valid-error"></i> <em class="valid-error">Vous devez d'abord enregistrer au moins un(e) élève</em><br/>
        <?}?>
            <?= form_error('eleve'); ?>
        </label>
        <a data-open="modal-create" class="button"><i class="fi-torsos-female-male"></i> Enregistrer un(e) nouvel(le) élève</a><br/><br/>
        
        <label>Type de prestation :
        <select name="type_prestation">
        <? foreach ($types_prest as $p) {?>
            <option value="<?=$p->id?>" <?=set_select('type_prestation', $p->id)?>><?=$p->libelle?></option>
        <?}?>
        </select>
        <?= form_error('type_prestation'); ?>
        </label>
        
        <label>Classe :
        <select name="classe_prestation" id="classe_prestation">  
            <? foreach ($classes as $c) {?>
            <option value="<?=$c->id?>" <?=set_select('classe_prestation', $c->id)?>><?=$c->libelle?></option>
            <?}?>
        </select>
        <?= form_error('classe_prestation'); ?>
        </label>
        
        <fieldset class="fieldset">
            <legend>Discipline(s) :</legend>
             <? foreach ($disciplines as $d) {?>
            <input id="<?=$d->id?>" type="checkbox" name="disciplines[]" value="<?=$d->id?>"  <?=set_checkbox('disciplines[]', $d->id); ?>><label for="<?=$d->id?>"><?=$d->libelle?></label>
            <?}?>
        <?= form_error('disciplines[]'); ?>
        </fieldset>
        
        <div class="clearfix">
            <div class="float-right">
                <input type="submit" class="button large" value="Étape suivante">
            </div>
        </div>
        </form>
        
    </div>
    

    
    
    <div class="reveal" id="modal-create" data-reveal>
        <h1>Ajouter un(e) élève</h1>            
        <?= form_open('utilisateur/ajouter_eleve?from=prestation','data-abide'); ?>
        <label>Nom
            <input type="text" name="nom-eleve" value="<?=set_value('nom-eleve')?>" maxlength="50" placeholder="Nom de l'élève" required>
            <?= form_error('nom-eleve'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom-eleve" value="<?=set_value('prenom-eleve')?>" maxlength="50" placeholder="Prénom de l'élève" required>
            <?= form_error('prenom-eleve'); ?>
        </label>

        <label>Classe
        <select name="classe">  
            <? foreach ($classes as $c) {?>
            <option value="<?=$c->id?>" <?=set_select('classe', $c->id)?>><?=$c->libelle?></option>
            <?}?>
        </select>
        <?= form_error('classe'); ?>
        </label>
            
        <div class="clearfix">
            <div class="float-right">
                 <input type="submit" class="button" value="Valider">
            </div>
        </div>

        </form>
            <button class="close-button" data-close aria-label="Fermer" type="button">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    
    <? $this->load->view('include/sidebar'); ?>
</div>