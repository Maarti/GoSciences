<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestation extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('prestation_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Classe';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
    }
    
    public function index(){
        redirect ('site/accueil');
    }

    public function reserver(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->load->model('eleve_model');
        $this->load->model('type_prestation_model');
        $this->load->model('utilisateur_model');
        $this->load->model('discipline_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Réserver une prestation';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences en Mathématiques, SVT, Physique et Chimie niveau collège et lycée à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir la prestation';
        $this->data['classes'] = $this->classe_model->read('id,libelle',array(),null,null,'ordre ASC')->result();
        $this->data['eleves'] = $this->eleve_model->read('id,nom,prenom,classe',array('parent'=>$_SESSION['id']))->result();
        $this->data['disciplines'] = $this->discipline_model->read('id,libelle')->result();
        $this->data['user'] = $this->utilisateur_model->read('tel,cp,ville,adresse',array('id'=>$_SESSION['id']))->row();
        // on propose tous les types de prestation sauf les stages
        $this->data['types_prest'] = $this->type_prestation_model->read('id,libelle',array('id !=' => 's'),null,null,'ordre ASC')->result();        
        $this->data['footer_include'][0] = '<script src="'.js_url('scripts/prestation_reserver').'"></script>';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/reserver', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_reserver(){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $this->form_validation->set_rules('eleve', 'Élève', 'required|callback_belong_to_user');
        $this->form_validation->set_rules('type_prestation', 'Type de prestation', 'required');
        $this->form_validation->set_rules('nb_heure','Nombre d\'heures','numeric|greater_than[0]|less_than[999]');
        $this->form_validation->set_rules('classe_prestation', 'Classe', 'required');
        $this->form_validation->set_rules('disciplines[]', 'Disciplines', 'required',array('required'=>'Vous devez sélectionner au moins une discipline.'));
        $this->form_validation->set_rules('tel', 'Téléphone', 'integer|exact_length[10]');
        $this->form_validation->set_rules('cp', 'Code postal', 'min_length[2]|max_length[5]');
        $this->form_validation->set_rules('ville', 'Ville', 'max_length[128]');
        $this->form_validation->set_rules('adresse', 'Adresse', 'max_length[256]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            // MaJ des coordonnées utilisateur si saisies
            $this->load->model('utilisateur_model');
            $user = $this->utilisateur_model->read('tel,cp,ville,adresse',array('id'=>$_SESSION['id']))->row();
            $updated_fields = array();
            if (!empty($this->input->post('tel')) && $this->input->post('tel')!=$user->tel)
                $updated_fields['tel'] = $this->input->post('tel');
            if (!empty($this->input->post('cp')) && $this->input->post('cp')!=$user->cp)
                $updated_fields['cp'] = $this->input->post('cp');
            if (!empty($this->input->post('ville')) && $this->input->post('ville')!=$user->ville)
                $updated_fields['ville'] = $this->input->post('ville');
            if (!empty($this->input->post('adresse')) && $this->input->post('adresse')!=$user->adresse)
                $updated_fields['adresse'] = $this->input->post('adresse');
            if (!empty($updated_fields))
                $this->utilisateur_model->update(array('id'=>$_SESSION['id']),$updated_fields);
            
            // Création de la prestation
            $this->prestation_model->create(array(
                    'etat'                  =>  'instance',
                    'nb_heure'              =>  $this->input->post('nb_heure'),
                    'disciplines'           =>  serialize($this->input->post('disciplines[]')),
                    'type_prestation_id'    =>  $this->input->post('type_prestation'),
                    'eleve_id'              =>  $this->input->post('eleve'),
                    'classe_id'             =>  $this->input->post('classe_prestation')),
              array('date_deb'              =>  'CURDATE()',
                    'date_creation'         =>  'NOW()')
            );
            // Retourne l'id de la dernière insertion
            $id_prest = $this->db->insert_id();
            $this->definir_disponibilites($id_prest);
        }else{
            $this->reserver();
        }
    }
    
     public function definir_disponibilites($id_prest=null){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $prest = $this->prestation_model->read('*',array('id'=>$id_prest))->row();
        if(empty($prest) || !$this->belong_to_user($prest->eleve_id))
            return redirect ('site/accueil', 'refresh');
        
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Définir vos disponibilités';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences et définissez vos disponibilités, nous vous proposerons des crénneaux horaires en conséquences. Nous nous déplaçons à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault et Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir vos disponibilités';

        $this->data['prestation'] = $prest;
        /*$this->data['header_include'][0] = '<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">';
        $this->data['footer_include'][0] = '<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>';
        $this->data['footer_include'][1] = '<script src="'.js_url('scripts/init_timepicker').'"></script>';
        $this->data['footer_include'][2] = '<script src="'.js_url('scripts/definir_disponibilites').'"></script>';*/
        $eventData = (empty($prest->disponibilite))? '{events : []}' : $prest->disponibilite;
        $this->data['header_include'][0] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery-ui-1.8.11.custom').'" />';
        $this->data['header_include'][1] = '<link rel="stylesheet" type="text/css" href="'.css_url('week-calendar/jquery.weekcalendar').'" />';
        $this->data['footer_include'][2] = '<script src="'.js_url('vendor/week-calendar/jquery-1.4.4.min').'"></script>';
        $this->data['footer_include'][3] = '<script src="'.js_url('vendor/week-calendar/jquery-ui-1.8.11.custom.min').'"></script>';
        $this->data['footer_include'][4] = '<script src="'.js_url('vendor/week-calendar/date').'"></script>';
        $this->data['footer_include'][5] = '<script src="'.js_url('vendor/week-calendar/jquery.weekcalendar').'"></script>';
        $this->data['footer_include'][6] = '<script type="text/javascript">var eventData = '.$eventData.'</script>';
        $this->data['footer_include'][7] = '<script src="'.js_url('vendor/week-calendar/init-week-calendar').'"></script>';
        
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/disponibilites', $this->data);
        $this->load->view('site/footer');
    }
    
     public function valid_disponibilites($id_prest=null){
         if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $prest = $this->prestation_model->read('*',array('id'=>$id_prest))->row();
        if(empty($prest) || !$this->belong_to_user($prest->eleve_id))
            return redirect ('site/accueil', 'refresh');
        
        $this->form_validation->set_rules('disponibilite', 'Disponibilités', 'callback_valid_json');        
        $this->form_validation->set_rules('commentaire', 'Commentaire', 'max_length[512]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            // Creation prestation
            $this->prestation_model->update(array('id'=>$id_prest),array(
                'disponibilite' => $this->input->post('disponibilite'),
                'etat'          => 'demande',
                'commentaire'   => $this->input->post('commentaire')
                ));
            $this->log_model->create_log('prestation','Demande de prestation','Id: '.$prest->id,$_SESSION['id']);
            
            // Envoi de mail            
            $this->load->model('utilisateur_model');
            $this->utilisateur_model->sendMail(
                    $this->config->item('mail_maarti'),
                    'DEMANDE DE PRESTATION',
                    'Une demande de prestation a été faite sur le site GoSciences.<br/>'
                    . 'Connectez-vous à <a href="'.site_url("admin/prestations").'">l\'administration</a> pour la consulter et y répondre.',
                    $this->config->item('mail_no_reply'),
                    'Système GoSciences');
                
            return redirect ('prestation/mes_cours/prestation_demandee', 'refresh');
        }else{
            $this->definir_disponibilites($id_prest);
        }
    }
    
    public function mes_cours($msg=null){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Mes cours';
        $this->data['meta_desc'] = 'Liste des cours GoSciences en Mathématiques, SVT, Physique et Chimie niveau collège et lycée à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->data['page_title'] = 'Mes cours';
      
        switch ($msg) { // Gestion des messages à afficher en page d'accueil
            case 'prestation_demandee':
                $type='success';
                $message='<h5>Demande effectuée.</h5><p>Votre demande de prestation a bien été prise en compte.<br/> L\'administrateur va bientôt prendre connaissance de votre demande et <strong>vous proposera bientôt des cours</strong> en fonction de vos horaires. Vous en serez informé(e) par e-mail.</p>'
                .'<p>Vous pouvez à tout moment consulter, modifier ou annuler votre demande depuis cette page.</p>';
                break;
            case 'demande_annulee':
                $type='success';
                $message='<h5>Demande annulée.</h5><p>Votre demande de prestation a été annulée.</p>';
                break;
            default:
                $type=NULL;
                $message=NULL;
        } 
        if(!is_null($type)&&!is_null($message))
            $this->data['msg']= '<div class="callout '.$type.'" data-closable>'.$message.'<button class="close-button" aria-label="Fermer" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
        
        $this->data['propositions']= $this->prestation_model->get_array($_SESSION['id'],array('etat'=>'propose'))->result();
        $this->data['demandes']= $this->prestation_model->get_array($_SESSION['id'],"etat = 'instance' OR etat='demande'")->result();

        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/mes_cours', $this->data);
        $this->load->view('site/footer');
    }
    
    // Clic sur la croix "annuler la demande" sur l'écran mes_cours
    public function annuler_demande($id_prest=null){
        if(!isset($_SESSION['id']))
            return redirect ('utilisateur/connexion/connexion_requise', 'refresh');
        $prest = $this->prestation_model->read('eleve_id',array('id'=>$id_prest))->row();
        if(empty($prest) || !$this->belong_to_user($prest->eleve_id))
            return redirect ('site/accueil', 'refresh');
        
        $delete = $this->prestation_model->update(array('id'=>$id_prest),array('etat'=>'annule'));
        $msg = ($delete)? 'demande_annulee' : null;
        return redirect ('prestation/mes_cours/'.$msg, 'refresh');
    }
    
    
    // Vérifie si l'id d'élève appartient au compte connecté
    public function belong_to_user($eleve_id) {
        $this->load->model('eleve_model');
        if ($this->eleve_model->belong_to_user($eleve_id))
          return TRUE;
        else {
          $this->form_validation->set_message('belong_to_user', 'L\'élève ne correspond pas à votre compte.');
          return FALSE;
        }
    }


    public function valid_json($string=null) {
        json_decode($string);
        if ($string == '{"events":[]}')
            return TRUE;    // Tableau vide
        elseif((json_last_error() == JSON_ERROR_NONE))
            // TODO Tester les valeurs présentent dans le json (sanitize)
            return TRUE;
        else{
            $this->form_validation->set_message('valid_json', 'Format des disponibilités incorrect.');         
            return FALSE;
        }
            
    }

}
