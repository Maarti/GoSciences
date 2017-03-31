<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classe extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Classe';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
    }
    
    public function index(){
        redirect ('site/accueil');
    }

    public function infos($id_classe=NULL){        
        $classe = $this->classe_model->read('libelle',array('id'=>$id_classe))->row();
        if ($classe){
            $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | '.$classe->libelle;
            $this->data['meta_desc'] = 'Découvrez les programmes de soutien sclaire proposés par GoSciences en Mathématiques, SVT, Physique et Chimie pour la classe de '.$classe->libelle.' à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
            $this->data['page_title'] = $classe->libelle;
            $this->data['matieres'] = $this->classe_model->get_matiere_from_class($id_classe)->result();
            $this->load->view('site/header', $this->data);
            $this->load->view('site/menu', $this->data);
            $this->load->view('classe/infos', $this->data);
            $this->load->view('site/footer');
        }else
            redirect ('site/accueil');
    }
}
