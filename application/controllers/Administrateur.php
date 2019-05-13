<?php
    class Administrateur extends CI_Controller {
        public function __construct(){
            parent::__construct();        
            $this->load->helper('url');
            $this->load->helper('assets');
            $this->load->helper('form');

            $this->load->model('ModeleAdmin');
            $this->load->model('ModeleArticle');

            $this->load->library('form_validation');
            $this->load->library('session'); 
            $this->load->library('pagination');



        } // Fin Administrateur

        public function AcceuilAdmin() {
            if((!is_null($this->session->profil)) and ($this->session->profil == "Administrateur")):
                // Redirect vers Partie Admin
                $this->load->view("Administrateur/PartieAdmin");
                
            else:
                // Redirect vers Acceuil
                redirect('Visiteur/PageDAccueilVisiteur');
            endif;
        } // Fin Accueil Admin

        public function Ajout(){
            $this->form_validation->set_rules('Categorie', 'Categorie', 'required');
            $this->form_validation->set_rules('Marque', 'Marque', 'required');
            $this->form_validation->set_rules('Libelle', 'Libelle', 'required');
            $this->form_validation->set_rules('Detail', 'Detail', 'required');
            $this->form_validation->set_rules('Image', 'Image', 'required');
            $this->form_validation->set_rules('PrixHT', 'PrixHT', 'required');
            $this->form_validation->set_rules('TauxTVA', 'TauxTVA', 'required');
            $this->form_validation->set_rules('Quantite', 'Quantite', 'required');
            $this->form_validation->set_rules('Date', 'Date', 'required');
            

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('template/Entete');
                $this->load->view('Administrateur/Ajout');
                $this->load->view('templates/PiedDePage');
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

        public function ListerLesArticlesAvecPagination() 
        {
            // les noms des entrées dans $config doivent être respectés
            $config = array();
            $config["base_url"] = site_url('Visiteur/ListerLesArticlesAvecPagination');
            $config["total_rows"] = $this->ModeleArticle->nombreDArticles();
            $config["per_page"] = 2; // nombre d'articles par page
            $config["uri_segment"] = 3; /* le n° de la page sera placé sur le segment n°3 de URI,
            pour la page 4 on aura : visiteur/listerLesArticlesAvecPagination/4       */        
            $config['first_link'] = ' Première Page ';
            $config['next_link'] = ' >>> ';
            $config['prev_link'] = ' <<< ';
            $config['last_link'] = ' Dernière page ';
     
            $this->pagination->initialize($config);
     
            $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
            /* on récupère le n° de la page - segment 3 - si ce segment est vide, cas du premier appel 
            de la méthode, on affecte 0 à $noPage */
           
            $DonneesInjectees['TitreDeLaPage'] = 'Bienvenue sur Nectron';
            $DonneesInjectees['lesArticles'] = $this->ModeleArticle->RetournerArticlesLimite($config["per_page"], $noPage);
            $DonneesInjectees['liensPagination'] = $this->pagination->create_links();
     
            $this->load->view('templates/Entete');
            $this->load->view('Visiteur/ListerLesArticlesAvecPagination', $DonneesInjectees);
            $this->load->view('templates/PiedDePage');
        } // fin listerLesArticlesAvecPagination
    
        public function Indisponible()
        {
            
        } //Fin Indisponible

        public function Disponible()
        {
            
        } //Fin Disponible
        
    }
?>