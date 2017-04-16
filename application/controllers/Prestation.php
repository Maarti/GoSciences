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
        $this->load->model('discipline_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Réserver une prestation';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences en Mathématiques, SVT, Physique et Chimie niveau collège et lycée à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir la prestation';
        $this->data['classes'] = $this->classe_model->read('id,libelle',array(),null,null,'ordre ASC')->result();
        $this->data['eleves'] = $this->eleve_model->read('id,nom,prenom,classe',array('parent'=>$_SESSION['id']))->result();
        $this->data['disciplines'] = $this->discipline_model->read('id,libelle')->result();
        // on propose tous les types de prestation sauf les stages
        $this->data['types_prest'] = $this->type_prestation_model->read('id,libelle',array('id !=' => 's'),null,null,'ordre ASC')->result();        
        $this->data['footer_include'][0] = '<script src="'.js_url('scripts/prestation_reserver').'"></script>';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/reserver', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valid_reserver(){
        $this->form_validation->set_rules('eleve', 'Élève', 'required|callback_belong_to_user');
        $this->form_validation->set_rules('type_prestation', 'Type de prestation', 'required');
        $this->form_validation->set_rules('classe_prestation', 'Classe', 'required');
        $this->form_validation->set_rules('disciplines[]', 'Disciplines', 'required',array('required'=>'Vous devez sélectionner au moins une discipline.'));
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $this->prestation_model->create(array(
                    'etat'                  =>  'propose',
                    'disciplines'           =>  serialize($this->input->post('disciplines[]')),
                    'type_prestation_id'    =>  $this->input->post('type_prestation'),
                    'eleve_id'              =>  $this->input->post('eleve'),
                    'classe_id'             =>  $this->input->post('classe_prestation')),
              array('date_deb'              =>  'CURDATE()')
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
        
        var_dump($prest);
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Définir vos disponibilités';
        $this->data['meta_desc'] = 'Réservez une prestation GoSciences et définissez vos disponibilités, nous vous proposerons des crénneaux horaires en conséquences. Nous nous déplaçons à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault et Jouy-le-Potier.';
        $this->data['page_title'] = 'Définir vos disponibilités';

        $this->data['prestation'] = $prest;
        $this->data['header_include'][0] = '<link href="http://cdn.jtsage.com/jtsage-datebox/4.1.1/jtsage-datebox-4.1.1.jqueryui.min.css" rel="stylesheet" type="text/css">';
        $this->data['header_include'][1] = '<script src="http://cdn.jtsage.com/jtsage-datebox/4.1.1/jtsage-datebox-4.1.1.jqueryui.min.js" type="text/javascript"></script>';
        //$this->data['header_include'][2] = '<script src="http://cdn.jtsage.com/jtsage-datebox/i18n/jquery.mobile.datebox.i18n.fr_FR.utf8.js" type="text/javascript" ></script>';
        //$this->data['footer_include'][0] = '<script src="'.js_url('scripts/prestation_disponibilites').'"></script>';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('prestation/disponibilites', $this->data);
        $this->load->view('site/footer');
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
}
