<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classe extends CI_Controller {

    public function __construct(){
        parent::__construct();                
    }
    
    public function index(){
        redirect ('site/accueil');
    }

    public function infos($id_classe=NULL){        
        $classe = $this->classe_model->read('libelle',array('id'=>$id_classe))->row();
        if ($classe){
            $data['page_title'] = 'GoSciences - '.$classe->libelle;
            $data['classe_libelle'] = $classe->libelle;
            $data['matieres'] = $this->classe_model->get_matiere_from_class($id_classe)->result();
            $this->load->view('site/header', $data);
            $this->load->view('site/menu', $data);
            $this->load->view('classe/infos', $data);
            $this->load->view('site/footer');
        }else
            redirect ('site/accueil');
    }
}
