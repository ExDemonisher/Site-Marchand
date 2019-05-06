<?php
class Visiteur extends CI_Controller
{

    public function __construct() {
        parent::__construct();        
        $this->load->helper('url');
        $this->load->helper('assets');
        $this->load->helper('form');

        $this->load->model('ModeleVisiteur');

        $this->load->library('form_validation');
        $this->load->library('session'); 
        $this->load->library('cart');
    }

    public function APropos() {
        $this->load->view('Visiteur/EnteteVisiteur');
        $this->load->view('Visiteur/APropos');
    }

    public function PageDAccueilVisiteur() {
        $this->load->view('Visiteur/EnteteVisiteur');
        $this->load->view('Visiteur/PageDAccueilVisiteur');
    }
    public function Catalogue() {
        $this->load->view('Visiteur/EnteteVisiteur');
        $this->load->view("templates/Catalogue");
    }
    public function Enregistrer() {        
        
        $this->form_validation->set_rules('NomUser', 'Nom', 'required');
        $this->form_validation->set_rules('PrenomUser', 'Prenom', 'required');
        $this->form_validation->set_rules('AdresseUser', 'Adresse', 'required');
        $this->form_validation->set_rules('VilleUser', 'Ville', 'required');
        $this->form_validation->set_rules('CodePostUser', 'Code postal', 'required');
        $this->form_validation->set_rules('EmailUser', 'Email', 'required');
        $this->form_validation->set_rules('Mdp', 'Mot de passe', 'required');
        $this->form_validation->set_rules('ConfirmMdp', 'Confirmation', 'required');
        $Mdp = $this->input->get_post('Mdp');
        $ConfirMdp= $this -> input -> get_post('ConfirmMdp');
            if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('Visiteur/EnteteVisiteur');
            $this->load->view('Visiteur/Enregistrer');
        }
        elseif ($Mdp <> $ConfirMdp)
        {
            $this->load->view('Visiteur/EnteteVisiteur');
            $this->load->view('Visiteur/Enregistrer');
        }
        else
        {
            $donneesAInserer = array(
            'NOM' => $this->input->post('NomUser'),
            'PRENOM' => $this->input->post('PrenomUser'),
            'ADRESSE' => $this->input->post('AdresseUser'),
            'VILLE' => $this->input->post('VilleUser'),
            'CODEPOSTAL' => $this->input->post('CodePostUser'),
            'EMAIL' => $this->input->post('EmailUser'),
            'MOTDEPASSE' => $this->input->post('Mdp'),
            'PROFIL' => "Client"    
            );
                $this->ModeleVisiteur->insererUnClient($donneesAInserer); // appel du modèle
                $DonneesInjectees['Nom'] = $this->input->post('NomUser');
                $this->load->view('Visiteur/EnteteVisiteur');
                $this->load->view('Visiteur/insertionReussie', $DonneesInjectees);
        }
    } // Fin Enregistrer

    public function Connecter()
    {      
       $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';        
       $this->form_validation->set_rules('EmailUser', 'Email', 'required');   
       $this->form_validation->set_rules('Mdp', 'Mot de passe', 'required');   
       // Les champs EmailUser et Mdp sont requis   
       // Si Mdp non renseigné envoi de la chaine 'Mot de passe' requis      
       if ($this->form_validation->run() === FALSE)
       {  // échec de la validation
        // cas pour le premier appel de la méthode : formulaire non encore appelé  
            $this->load->view('templates/Entete');
            $this->load->view('visiteur/Connecter', $DonneesInjectees); // on renvoie le formulaire    
       }  
       else  
       {  // formulaire validé 
            $Utilisateur = array( // cIdentifiant, cMotDePasse : champs de la table tabutilisateur 
                'EMAIL' => $this->input->post('EmailUser'),  
                'MOTDEPASSE' => $this->input->post('Mdp'),    
            ); // on récupère les données du formulaire de connexion    
            // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
            $NomProfilRetourne = $this->ModeleVisiteur->retournerNomProfil($Utilisateur); 
            if (!($NomProfilRetourne == null))
            {    // on a trouvé, identifiant et statut (droit) sont stockés en session  
                
                $this->session->nom = $NomProfilRetourne->NOM;
                $this->session->prenom = $NomProfilRetourne->PRENOM;
                $this->session->profil = $NomProfilRetourne->PROFIL;

                var_dump($NomProfilRetourne);
                
                redirect('Visiteur/Visiteur/PageDAccueilVisiteur');
            } 
            else
            {    // utilisateur non trouvé on renvoie le formulaire de connexion 
            $this->load->view('templates/Entete');
            $this->load->view('visiteur/Connecter', $DonneesInjectees);
            }    
        }   
    } // Fin Connecter

    public function Deconnection() {
        $this->session->sess_destroy();

        redirect('Visiteur/Visiteur/PageDAccueilVisiteur');
    } // Fin Deconnection

    public function Profil() {
        if((!is_null($this->session->profil)) and ($this->session->profil == "Client")):
            //Redirect vers le profil client
            $this->load->view('Visiteur/Profil');
        else:
            // Redirect vers Acceuil
            redirect('Visiteur/Visiteur/PageDAccueilVisiteur');
        endif;
    } //Fin Profil


    public function Cart() {
       
    
    } //Fin Cart

} 