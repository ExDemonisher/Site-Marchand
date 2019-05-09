<?php
    class Administrateur extends CI_Controller {
        public function __construct(){
            parent::__construct();        
            $this->load->helper('url');
            $this->load->helper('assets');
            $this->load->helper('form');

            $this->load->model('ModeleAdmin');

            $this->load->library('form_validation');
            $this->load->library('session'); 
        } // Fin Administrateur

        public function AcceuilAdmin() {
            if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
                // Redirect vers Partie Admin
                $this->load->view("Administrateur/PartieAdmin");
                
            else:
                // Redirect vers Acceuil
                redirect('Visiteur/Visiteur/PageDAccueilVisiteur');
            endif;
        } // Fin Accueil Admin

        public function Ajout(){
            $this->form_validation->set_rules('Categorie', 'Categorie', 'required');
            $this->form_validation->set_rules('Marque', 'Marque', 'required');
            $this->form_validation->set_rules('Libelle', 'Libelle', 'required');
            $this->form_validation->set_rules('Detail', 'Detail', 'required');
            $this->form_validation->set_rules('PrixHT', 'PrixHT', 'required');
            $this->form_validation->set_rules('TauxTVA', 'TauxTVA', 'required');
            $this->form_validation->set_rules('Quantite', 'Quantite', 'required');
            $this->form_validation->set_rules('Date', 'Date', 'required');
            

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('template/Entete');
                $this->load->view('Administrateur/Ajout');
            }
            else
            {
                $Categorie=$this->ModeleAdmin->retournerCategorie($this->input->post('Categorie'));
                $Marque=$this->ModeleAdmin->retournerMarque($this->input->post('Marque'));
                $donneesAInserer = array(
                    'NOCATEGORIE' => $Categorie->NOCATEGORIE,
                    'NOMARQUE' => $Marque->NOMARQUE,
                    'LIBELLE' => $this->input->post('Libelle'),
                    'DETAIL' => $this->input->post('Detail'),
                    'PRIXHT' => $this->input->post('PrixHT'),
                    'TAUXTVA' => $this->input->post('TauxTVA'),
                    'QUANTITEENSTOCK' => $this->input->post('Quantite'),
                    'DATEAJOUT' => $this->input->post('Date'),
                    'DISPONIBLE' => 1
                    );
                        $this->ModeleAdmin->AjouterUnProduit($donneesAInserer);
                        $DonneesInjectees['Libelle'] = $this->input->post('Libelle');
                        $this->load->view('template/Entete');
                        $this->load->view('Administrateur/AjoutEffectue', $DonneesInjectees);
            }
        } // Fin Ajout
    }
?>