<?php
    class Administrateur extends CI_Controller {
        public function __construct(){
            parent::__construct();

            $this->load->helper('url');
            $this->load->helper('form');

            $this->load->library('session');
        }

        public function AcceuilAdmin() {
            if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
                // Redirect vers Partie Admin
                $this->load->view("Administrateur/PartieAdmin");
                
            else:
                // Redirect vers Acceuil
                redirect('Visiteur/Visiteur/PageDAccueilVisiteur');
            endif;
        }
    }
?>