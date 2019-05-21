<?php
class Visiteur extends CI_Controller
{

    public function __construct() 
    {
        parent::__construct();        
        $this->load->helper('url');
        $this->load->helper('assets');
        $this->load->helper('form');

        $this->load->model('ModeleVisiteur');
        $this->load->model('ModeleArticle');

        $this->load->library('form_validation');
        $this->load->library('session'); 
        $this->load->library('cart');
        $this->load->library('pagination');
    }

    public function APropos() 
    {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/APropos');
        $this->load->view('templates/PiedDePage');
    }

    public function PageDAccueilVisiteur()
    {
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/PageDAccueilVisiteur');
        $this->load->view('templates/PiedDePage');
    }
    public function Catalogue() 
    {
        $this->load->view('templates/Entete');
        $this->load->view('templates/Catalogue');
        $this->load->view('templates/PiedDePage');
    }
    public function Enregistrer() 
    {        
        
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
            $this->load->view('templates/Entete');
            $this->load->view('Visiteur/Enregistrer');
        }
        elseif ($Mdp <> $ConfirMdp)
        {
            $this->load->view('templates/Entete');
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
                $this->load->view('templates/Entete');
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
                $this->session->num = $NomProfilRetourne->NOCLIENT;

                var_dump($NomProfilRetourne);
                
                redirect('Visiteur/PageDAccueilVisiteur');
            } 
            else
            {    // utilisateur non trouvé on renvoie le formulaire de connexion 
            $this->load->view('templates/Entete');
            $this->load->view('visiteur/Connecter', $DonneesInjectees);
            }    
        }   
    } // Fin Connecter

    public function Deconnection() 
    {
        $this->session->sess_destroy();

        redirect('Visiteur/PageDAccueilVisiteur');
    } // Fin Deconnection

    public function Profil() {
        if((!is_null($this->session->profil)) and ($this->session->profil == "Client")):
            //Redirect vers le profil client
            $this->load->view('templates/entete');
            $this->load->view('Visiteur/Profil');
            $this->load->view('templates/PiedDePage');
        else:
            // Redirect vers Acceuil
            redirect('Visiteur/PageDAccueilVisiteur');
        endif;
    } //Fin Profil

    public function ListerUnArticle()//Lister tous les articles
    {
        $DonneesInjectees['lesArticles'] = $this->ModeleArticle->retournerArticles();
        $DonneesInjectees['TitreDeLaPage'] = 'Liste Des articles';

        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/listerLesArticles', $DonneesInjectees);
    } //Fin ListerLesArticles

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

    public function voirUnArticle($noArticle = NULL) // valeur par défaut de noArticle = NULL
    {
        $DonneesInjectees['unArticle'] = $this->ModeleArticle->retournerArticles($noArticle);
        // $this->session->noproduit = $noArticle->
        if (empty($DonneesInjectees['unArticle']))
        {   // pas d'article correspondant au n°
            show_404();
        }
        $DonneesInjectees['TitreDeLaPage'] = $DonneesInjectees['unArticle']['LIBELLE'];
        // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
        $this->load->view('templates/Entete');
        $this->load->view('Visiteur/VoirUnArticle', $DonneesInjectees);
        $this->load->view('templates/PiedDePage');
    } // voirUnArticle

    public function BarreDeRecherche()
    {
        $this->load->library('form_validation');
        $recherche = array( 'LIBELLE' => '' ); // default when no term in session or POST
            if ($this->input->post('recherche'))
            {
                // use the term from POST and set it to session
                $recherche = array(
                    'LIBELLE' => $this->input->post('recherche'),
                    );
                $this->session->set_userdata('recherche', $recherche);
            }
            elseif ($this->session->userdata('recherche'))
            {
                // if term is not in POST use existing term from session
                $recherche = $this->session->userdata('recherche');
            }
            
        $config = array();
        $config["base_url"] = site_url('Visiteur/BarreDeRecherche');
        $config["total_rows"] = $this->ModeleArticle->nombreDArticlesRecherche($recherche);
        $config["per_page"] = 3; // nombre d'articles par page
        $config["uri_segment"] = 3; 
        $config['first_link'] = 'Premier'; 
        $config['last_link'] = 'Dernier'; 
        $config['next_link'] = 'Suivant'; 
        $config['prev_link'] = 'Précédent';    
        $this->pagination->initialize($config); 
        $noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $DonneesInjectees['TitreDeLaPage'] = 'Résultat pour : '.$this->input->post('recherche'); 
        $DonneesInjectees["liensPagination"] = $this->pagination->create_links(); 
        $DonneesInjectees["lesArticles"] = $this->ModeleArticle->retournerArticlesLimiteRecherche($config["per_page"], $noPage,$recherche);
        $this->load->view('templates/Entete'); 
        $this->load->view("Visiteur/listerLesArticlesAvecPagination", $DonneesInjectees); 
        $this->load->view('templates/PiedDePage'); 
    } //Fin BarreDeRecherche
    
    public function ajouterPanier(){

        $noArticle = $this->input->post('noproduit');
        $nomArticle = $this->input->post('nomproduit');
        $prixTTC = $this->input->post('prixTTC');
        $quantite = $this->input->post('quantite');
        $data = array(
                 'id' => $noArticle,
                 'qty'    => $quantite,
                 'price'    => $prixTTC,
                 'name'   => $nomArticle
        );

        $this->cart->insert($data);
        $this->session->prixPanier = $this->cart->total();
        $this->session->totalArticle = $this->cart->total_items();

        redirect('Visiteur/Panier');
     } //Fin AjoutPanier

    public function modifierPanier(){
        $NbTotalArt = count($this->cart->contents());

        for ($i=1;$i <= $NbTotalArt;$i++)
        {

           $data = array(
              'rowid' => $this->input->post($i.'[rowid]'),
              'qty' => $this->input->post($i.'[qty]')
           );
           $this->cart->update($data);
        }
        $this->session->prixPanier = $this->cart->total();
        $this->session->totalArticle = $this->cart->total_items();

        redirect('Visiteur/Panier');

    } //Fin ModifierPanier

    public function passerCommandes() {

        $data = array(
           'NOCLIENT' => $this->session->num,
           'DATECOMMANDE' => date('Y-m-d H:i:s')
        );
        var_dump($this->session);
        $LeNum = $this->session->num;
        $data = $this->ModeleArticle->AddCmd($data);

        foreach ($this->cart->contents() as $items)
        {
            $NoCommande = $this->ModeleArticle->RetournerNoCommande($LeNum);
            $id= $items['id'];
            $quantite = $items['qty'];
            $data = array (
            'NOCOMMANDE' => $NoCommande['NOCOMMANDE'],
            'NOPRODUIT' => $id,
            'QUANTITECOMMANDEE' => $quantite
            );
            $this->ModeleArticle->InsertLigne($data);
        }
        $this->cart->destroy();
        redirect('Visiteur/PageDAccueilVisiteur');
    } //Fin PasserCommande

    public function supprimerDuPanier()
    {
        $data = array(
            'rowid' => $this->uri->segment(3),
            'qty' => 0
        );
        $this->cart->update($data);
        $this->session->prixPanier = $this->cart->total();
        $this->session->totalArticle = $this->cart->total_items();

        redirect('Visiteur/panier');
    } //Fin SupprimerDuPanier

    public function panier() {

        $this->session->prixPanier = $this->cart->total();
        $this->session->totalArticle = $this->cart->total_items();

        $this->load->view('templates/Entete');
        $this->load->view("Visiteur/Profil");
        $this->load->view('templates/PiedDePage');

    }


    
} //Fin Classe