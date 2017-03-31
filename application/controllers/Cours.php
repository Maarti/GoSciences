<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cours extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Cours';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        //$this->output->enable_profiler(true);
    }
    
    public function index(){
        $this->tarifs();
    }

    public function tarifs($id_prest = null){
        $this->load->model('prestation_model'); 
        $this->data['tarifs'] = $this->classe_model->get_tarifs($id_prest);
        $libelle_prest = $this->prestation_model->read('libelle',array('id'=>$id_prest))->row();
        if (empty($this->data['tarifs']) || empty($libelle_prest))
            redirect('site/accueil', 'refresh');
        else{
            $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Tarifs '.$libelle_prest->libelle;
            $this->data['meta_desc'] = 'Découvrez les tarifs "'.$libelle_prest->libelle.'" proposés par GoSciences en Mathématiques, SVT, Physique et Chimie pour les différentes classes du collège et du lycée à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
            $this->data['id_prest'] = $id_prest;
            $this->data['page_title'] = 'Tarifs '.$libelle_prest->libelle;
            $this->load->view('site/header', $this->data);
            $this->load->view('site/menu', $this->data);
            $this->load->view('cours/tarifs', $this->data);
            $this->load->view('site/footer');
        }
    }
        
}
