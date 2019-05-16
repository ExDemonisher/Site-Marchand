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


            if((is_null($this->session->profil)) or ($this->session->profil != "Administrateur")):
                // Redirect vers Acceuil
                redirect('Visiteur/PageDAccueilVisiteur');
            endif;
            
        } // Fin Administrateur
        
        public function AcceuilAdmin() {
            $this->load->view("Administrateur/PartieAdmin");
        } // Fin Accueil Admin

        public function Ajout()
            {
                $this->load->helper('form');
                $this->load->library('form_validation');
        
                $DonneesInjectees['Marques']       = $this->ModeleAdmin->retournerUneMarque();
                $DonneesInjectees['Categories']    = $this->ModeleAdmin->retournerUneCategorie();
        
                // Ci-dessous on 'pose' les règles de validation
                $this->form_validation->set_rules('Libelle', 'Titre', 'required');
                $this->form_validation->set_rules('Detail', 'detail', 'required');
                $this->form_validation->set_rules('categorie', 'Categorie', 'required');
                $this->form_validation->set_rules('marque', 'marque', 'required');
                $this->form_validation->set_rules('PrixHT', 'prixht', 'required');
                $this->form_validation->set_rules('TauxTVA', 'taux', 'required');
                $this->form_validation->set_rules('Image', 'image', 'required');
                $this->form_validation->set_rules('Quantite', 'quantiter', 'required');
        
        
                // l'image n'est pas obligatoire : pas required
        
                if ($this->form_validation->run() === FALSE) { // formulaire non validé, on renvoie le formulaire
                    $this->load->view('templates/Entete');
                    $this->load->view('Administrateur/Ajout', $DonneesInjectees);
                    $this->load->view('templates/PiedDePage');
                } else {
                    $donneesAInserer = array(
                        'LIBELLE' => $this->input->post('Libelle'),
                        'DETAIL' => $this->input->post('Detail'),
                        'NOCATEGORIE' => $this->input->post('categorie'),
                        'NOMARQUE' => $this->input->post('marque'),
                        'PRIXHT' => $this->input->post('PrixHT'),
                        'TAUXTVA' => $this->input->post('TauxTVA'),
                        'NOMIMAGE' => $this->input->post('Image'),
                        'QUANTITEENSTOCK' => $this->input->post('Quantite'),
                        'DATEAJOUT' => date('Y-m-d/H:i:s'),
                        'DISPONIBLE' => 1
        
                    ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
                    $this->ModeleAdmin->insererUnArticle($donneesAInserer); // appel du modèle
                    $this->load->view('templates/Entete');
                    $this->load->view('Administrateur/AjoutEffectue');
                    $this->load->view('templates/PiedDePage'); } } // ajouterUnArticle

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
    
        public function Indisponible($pNoProduit)
        {
            $donneesaModifier = array(
                'DISPONIBLE' => 0
            );
            $this->ModeleAdmin->dispo($donneesaModifier, $pNoProduit);
            redirect('Visiteur/PageDAccueilVisiteur');
        } //Fin Indisponible

        public function Disponible($pNoProduit)
        {
            $donneesaModifier = array(
                'DISPONIBLE' => 1
            );
           
            $this->ModeleAdmin->dispo($donneesaModifier, $pNoProduit);
            redirect('Visiteur/PageDAccueilVisiteur');
        } //Fin Disponible
        
        public function ModifPrix($pNoProduit)
        {
            $this->form_validation->set_rules('NouvPrix', 'NouvPrix', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/Entete');
                $this->load->view('Administrateur/ModifPrixProduit');
                $this->load->view('templates/PiedDePage');
            }
            else
            {
                $donneesAModifier = array(
                'PRIXHT' => $this->input->post('NouvPrix')
            );
            $this->ModeleAdmin->ModifierUnProduit($donneesAModifier, $pNoProduit); // appel du modèle
            $donneesaInjectee['Prix'] = $this->input->post('NouvPrix');
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/ModifReussie', $DonneesInjectees);
            }
            
        } //Fin ModifPrix

        public function ModifQty($pNoProduit)
        {
            echo "No Produit : ".$pNoProduit;

            $this->form_validation->set_rules('NouvQty', 'NouvQty', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/Entete');
                $this->load->view('Administrateur/ModifQtyProduit');
                $this->load->view('templates/PiedDePage');
            }
            else
            {
                $donneesAModifier = array(
                'QUANTITEENSTOCK' => $this->input->post('NouvQty')  
            );
            $this->ModeleAdmin->ModifierUnProduit($donneesAModifier, $pNoProduit);
            $donneesaInjectee['Quantite'] = $this->input->post('NouvQty');
            $this->load->view('templates/Entete');
            $this->load->view('Administrateur/ModifReussie', $DonneesInjectees);
            }
        }
    }
?>