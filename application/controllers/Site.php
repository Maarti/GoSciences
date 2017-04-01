<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Accueil';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans, La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        //$this->output->enable_profiler(true);                
    }
    
    public function index(){
        $this->accueil();
    }

    public function accueil(){
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Accueil';
        $this->data['meta_desc'] = 'GoSciences propose de l\'aide scolaire de qualité dans les matières scientifiques à Orléans,  La Ferté-Saint-Aubin, La Chapelle-Saint-Mesmin, Saint-Jean-de-Braye, Saint-Jean-le-Blanc, Saint-Jean-de-la-Ruelle, Olivet, Saran, Lamotte-Beuvron, Vouzon, Marcilly-en-Villette, Menestreau-en-Villette, Saint-Cyr-en-Val, Ligny-le-Ribault, Jouy-le-Potier.';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('site/accueil', $this->data);
        $this->load->view('site/footer');
    }

    public function contact($msg=NULL,$contact=NULL,$motif=NULL){
        $this->load->helper('form');
        $this->load->library('format_string');
        $this->load->model('utilisateur_model');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Nous contacter';
        $this->data['meta_desc'] = 'Contacter GoSciences pour bénéficier de cours particuliers de qualité dans les matières scientifiques ou postuler en tant que professeur dans le Loiret.';
        $this->data['page_title'] = 'Nous Contacter';
        $this->data['contact_user'] = $this->utilisateur_model->read('nom,prenom,tel',array('mail'=>'gosciences@outlook.fr'))->row();
        $this->data['add_jquery'] = '<script src="'.js_url('scripts/postuler').'"></script>';
        if(!empty($contact))    $_GET['contact']=$contact;
        if(!empty($motif))      $_GET['motif']=$motif;
        if (isset($_SESSION['id'])){
            $this->data['mail'] = $this->utilisateur_model->read('mail',array('id'=>$_SESSION['id']))->row()->mail;
            $this->data['nom'] = $_SESSION['nom'];
            $this->data['prenom'] = $_SESSION['prenom'];
        }else{
            $this->data['mail'] = '';$this->data['nom']='';$this->data['prenom']='';
        }

        switch ($msg) { // Gestion des messages à afficher
        case 'envoi_ok':
            $type='success';
            $message='<h5>Envoi réussi.</h5><p>Merci, nous prendrons connaissance de votre message dès que possible.</p>';
            break;
        default:
            $type=NULL;
            $message=NULL;
        } 
        if(!is_null($type)&&!is_null($message))
        $this->data['msg']= '<div class="callout '.$type.'" data-closable>'.$message.'<button class="close-button" aria-label="Fermer" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';

        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('site/contact', $this->data);
        $this->load->view('site/footer');
    }

     public function valid_contact(){
        $this->load->model('utilisateur_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom', 'Nom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|min_length[2]|max_length[50]|regex_match[/^([-a-z_éèàêâùïüë ])+$/i]');
        $this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|max_length[254]');
        $this->form_validation->set_rules('motif', 'Motif', 'required|in_list[info,postuler,bug,autre]');
        $this->form_validation->set_rules('message', 'Message', 'required|min_length[10]|max_length[2000]');
        $this->form_validation->set_error_delimiters('<p class="help-text valid-error">', '</p>');

        if ($this->form_validation->run()) {
            $mail = $this->input->post('mail');
            $nom = $this->input->post('nom');
            $prenom = $this->input->post('prenom');
            $message = $this->input->post('message');
            
            // Si il y a upload de ficher
            if($this->input->post('motif')=='postuler'){
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'doc|docx|pdf|odt';
                $config['max_size']             = 2048; // 2048KB = 2MO
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('cv')){
                    //$upload_data = $this->upload->data();
                    $this->utilisateur_model->sendMail('contact@gosciences.fr,contact@maarti.net', 'Contact depuis GoSciences', $message, $mail, $nom.' '.$prenom,$this->upload->data('full_path'));
                    redirect('site/contact/envoi_ok', 'refresh');
                }else{
                    $this->data['upload_error'] = $this->upload->display_errors('<p class="help-text valid-error">','</p>');
                    $this->contact(NULL,'email');
                }
            }else{                
                $this->utilisateur_model->sendMail('contact@gosciences.fr,contact@maarti.net', 'Contact depuis GoSciences', $message, $mail, $nom.' '.$prenom);
                redirect('site/contact/envoi_ok', 'refresh');
            }
        }else
            $this->contact(NULL,'email');
     }

     public function not_found(){
        $this->output->set_status_header('404');
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Page introuvable';
        $this->data['meta_desc'] = 'Cette page n\'existe pas ou plus. Merci de revenir à l\'accueil.';
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('site/error_404', $this->data);
        $this->load->view('site/footer');
    }
    
    public function equipe(){
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Notre équipe';
        $this->data['meta_desc'] = 'L’équipe pédagogique de GoSciences est composée de docteurs, d’enseignants diplômés et confirmés, d’ingénieurs mais également d’étudiants issus des meilleures écoles scientifiques.';
        $this->data['page_title'] = 'Notre Équipe';            
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('site/equipe', $this->data);
        $this->load->view('site/footer');
    }
    
    public function valeurs(){
        $this->data['tab_title'] = 'GoSciences - Aide scolaire à Orléans et ses environs | Nos valeurs';
        $this->data['meta_desc'] = 'GoSciences attache une importance particulière à son recrutement de qualité. Nos enseignants sont captivés par les sciences et pédagogues.';
        $this->data['page_title'] = 'Nos Valeurs';            
        $this->load->view('site/header', $this->data);
        $this->load->view('site/menu', $this->data);
        $this->load->view('site/nos_valeurs', $this->data);
        $this->load->view('site/footer');
    }
        
}
