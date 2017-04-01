<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row small-uncollapse">
    <div class="small-12 medium-8 columns">
        <? $this->load->view('include/pagetitle'); ?>
        <? if (isset($msg)) echo $msg; ?>
        
        <ul class="accordion" data-accordion>
            <? if(!empty($contact_user) && !empty($contact_user->tel)){?>
            <li class="accordion-item<?=(isset($_GET['contact']) && $_GET['contact']=='telephone')? ' is-active' : ''?>" data-accordion-item>
              <a href="#" class="accordion-title">Téléphone</a>
              <div class="accordion-content" data-tab-content>
                  <i class="fi-torso-business"></i> <?=$contact_user->prenom?> <?=$contact_user->nom?><br/>
                  <i class="fi-telephone"></i> <?=$this->format_string->format_tel($contact_user->tel)?>
              </div>
            </li>
            <?}?>
            <li class="accordion-item<?=(isset($_GET['contact']) && $_GET['contact']=='email')? ' is-active' : ''?>" data-accordion-item>
              <a href="#" class="accordion-title">E-mail</a>
              <div class="accordion-content" data-tab-content>
                  <?= form_open('site/valid_contact','data-abide'); ?>      
                    <label>Nom
                        <input type="text" name="nom" value="<?php echo set_value('nom',$nom); ?>" maxlength="50" placeholder="Nom" required>
                        <?= form_error('nom'); ?>
                    </label>   

                    <label>Prénom
                        <input type="text" name="prenom" value="<?= set_value('prenom',$prenom) ?>" maxlength="50" placeholder="Prénom" required>
                        <?= form_error('prenom'); ?>
                    </label>

                    <label>E-mail
                        <input type="email" name="mail" value="<?= set_value('mail',$mail) ?>" size="254" placeholder="exemple@domaine.fr" required>
                        <?= form_error('mail'); ?>
                    </label>

                    <label>Motif
                        <select name="motif">
                          <option value="info" <?=set_select('motif', 'info', (isset($_GET['motif']) && $_GET['motif']=='info'))?>>Demande d'information</option>
                          <option value="postuler" <?=set_select('motif', 'postuler',(isset($_GET['motif']) && $_GET['motif']=='postuler'))?>>Postuler</option>
                          <option value="bug" <?=set_select('motif', 'bug',(isset($_GET['motif']) && $_GET['motif']=='bug'))?>>Rapporter un bug</option>
                          <option value="autre" <?=set_select('motif', 'autre',(isset($_GET['motif']) && $_GET['motif']=='autre'))?>>Autre</option>
                        </select>
                        <?= form_error('motif'); ?>
                    </label>

                    <label>Message
                        <textarea name="message" placeholder="Votre message" rows="10" maxlength="2000" autofocus required><?= set_value('message') ?></textarea>
                        <?= form_error('message'); ?>
                    </label>

                    <div class="clearfix">
                        <div class="float-right">
                            <input type="submit" class="button" value="Valider">
                        </div>
                    </div>

                    </form>
              </div>
            </li>
        </ul>
        
      
        
    </div>
    <? $this->load->view('include/sidebar'); ?>

</div>