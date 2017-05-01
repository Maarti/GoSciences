<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>

        <?= form_open('utilisateur/valid_infos','data-abide'); ?>

        <label>E-mail
            <input type="email" name="mail" value="<?=$user->mail?>" maxlength="254" placeholder="exemple@domaine.fr" readonly>
        </label>
        
         <label>Nouveau mot de passe <em>(laissez vide si vous ne souhaitez pas le changer)</em>
            <input type="password" id="newpass" name="newpass" value="" maxlength="50" autocomplete="new-password">
            <?= form_error('newpass'); ?>
        </label>

        <label id="newpassconf" hidden>Confirmation du nouveau mot de passe
            <input type="password" name="newpassconf" value="" maxlength="50" autocomplete="new-password">            
        </label>
        <?= form_error('newpassconf'); ?>
        
        <fieldset>
            <legend>Civilité</legend>
            <input type="radio" name="civilite" value="Mme" id="Mme" <?=set_radio('civilite', 'Mme', $user->civilite=='Mme')?>><label for="Mme">Mme</label>
            <input type="radio" name="civilite" value="M." id="M" <?=set_radio('civilite', 'M.', $user->civilite=='M.')?>><label for="M">M.</label>
        </fieldset>
        <?= form_error('civilite'); ?>

        <label>Nom
            <input type="text" name="nom" value="<?=set_value('nom',$user->nom)?>" maxlength="50" placeholder="Nom" required>
            <?= form_error('nom'); ?>
        </label>   

        <label>Prénom
            <input type="text" name="prenom" value="<?=set_value('prenom',$user->prenom)?>" maxlength="50" placeholder="Prénom" required>
            <?= form_error('prenom'); ?>
        </label>
        
        <label>Date de naissance
            <input type="date" name="date_naissance" value="<?=set_value('date_naissance',$user->date_naissance)?>" max="2017-07-01" min="1880-01-01" placeholder="2000-01-01">
            <?= form_error('date_naissance'); ?>
        </label>
        
        <label>Téléphone
            <input type="text" name="tel" value="<?=set_value('tel',$user->tel)?>" maxlength="10" placeholder="0600000000">
            <?= form_error('tel'); ?>
        </label>
        
        <label>Code postal
            <input type="text" pattern="[0-9]{5}" name="cp" value="<?=set_value('cp',$user->cp)?>" maxlength="5" placeholder="45000">
            <?= form_error('cp'); ?>
        </label>
        
        <label>Ville
            <input type="text" list="ville" name="ville" value="<?=set_value('ville',$user->ville)?>" maxlength="128" placeholder="Orléans">
            <datalist id="ville">
                <? // Autocompletion
                   $villes = array("Orléans", "La Ferté-Saint-Aubin", "La Chapelle-Saint-Mesmin", "Saint-Jean-de-Braye", "Saint-Jean-le-Blanc", "Saint-Jean-de-la-Ruelle", "Olivet", "Saran", "Lamotte-Beuvron", "Vouzon", "Marcilly-en-Villette", "Menestreau-en-Villette", "Saint-Cyr-en-Val", "Ligny-le-Ribault", "Jouy-le-Potier");
                   foreach ($villes as $v){
                       echo '<option value="'.$v.'">';
                   } 
                ?>
            </datalist>
            <?= form_error('ville'); ?>
        </label>
        
        <label>Adresse
            <input type="text" name="adresse" value="<?=set_value('adresse',$user->adresse)?>" maxlength="256" placeholder="15 bis, Rue De La Réussite">
            <?= form_error('adresse'); ?>
        </label>
        
        <fieldset class="fieldset">
            <legend>Élèves :</legend>
            <? foreach ($eleves as $e) {?>
                <a data-open="modal-update-<?=$e->id?>"><i class="fi-page-edit"></i> <?=$e->nom?> <?=$e->prenom?></a><br/>
            <?}?>
            <?if(empty($eleves)){?>
                <em>Aucun élève pour le moment</em>
            <?}?>
            <br>
            <a data-open="modal-create" class="button"><i class="fi-torsos-female-male"></i> Ajouter un(e) élève</a>
        </fieldset>

        <div class="clearfix">
            <div class="float-right">
                <input type="submit" class="button" value="Valider">
            </div>
        </div>
        </form>        
        <br/>
        
        <div class="reveal" id="modal-create" data-reveal>
            <h1>Ajouter un(e) élève</h1>            
            <?= form_open('utilisateur/ajouter_eleve','data-abide'); ?>
            <label>Nom
                <input type="text" name="nom-eleve" value="<?=set_value('nom-eleve',$user->nom)?>" maxlength="50" placeholder="Nom de l'élève" required>
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
        
        <? foreach ($eleves as $e) {?>
        <div class="reveal" id="modal-update-<?=$e->id?>" data-reveal>
            <h1><?=$e->nom?> <?=$e->prenom?></h1>            
            <?= form_open('utilisateur/modifier_eleve','data-abide'); ?>
            <input type="hidden" name="id" value="<?=$e->id?>">
            <label>Classe
            <select name="classe">  
                <? foreach ($classes as $c) {?>
                <option value="<?=$c->id?>" <?=set_select('classe', $c->id, $c->id==$e->classe)?>><?=$c->libelle?></option>
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
        <?}?>

    </div>
    <? $this->load->view('include/sidebar'); ?>
    
    
</div>