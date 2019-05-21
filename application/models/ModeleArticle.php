<?php
    class ModeleArticle extends CI_Model 
    {
        public function __construct()
        { 
            $this->load->database();
            /* chargement database.php (dans config), obligatoirement dans le constructeur */
        }
        public function retournerArticles($pNoArticle = FALSE)
        {
            if ($pNoArticle === FALSE) // pas de n° d'article en paramètre
            {  // on retourne tous les articles
                $requete = $this->db->get('produit');
                return $requete->result_array(); // retour d'un tableau associatif
            }  
            // ici on va chercher l'article dont l'id est $pNoArticle
            $requete = $this->db->get_where('produit', array('NOPRODUIT' => $pNoArticle));    
            return $requete->row_array(); // retour d'un tableau associatif
        } // fin retournerArticles

		public function nombreDArticles() { // méthode utilisée pour la pagination
        	return $this->db->count_all("produit");
    	} // nombreDArticles

    	public function RetournerArticlesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    	{ 	// Nota Bene : surcharge non supportée par PHP 
    		$this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
	        $requete = $this->db->get("produit");
	 
	        if ($requete->num_rows() > 0) { // si nombre de lignes > 0
	            foreach ($requete->result() as $ligne) {
	                $jeuDEnregsitrements[] = $ligne;
	            }
	            return $jeuDEnregsitrements;
	        }
	        return false;
        } // Fin RetournerArticlesLimite

        public function nombreDArticlesRecherche($pRecherche) 
        { // méthode utilisée pour la pagination
            $this->db->select(); 
            $this->db->like($pRecherche); 
            return $this->db->count_all_results("produit");
        }

        public function retournerArticlesLimiteRecherche($nombreDeLignesARetourner, $noPremiereLigneARetourner, $pRecherche)
        {// Nota Bene : surcharge non supportée par PHP
            $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner); 
            $this->db->select('NOPRODUIT, LIBELLE, DETAIL, PRIXHT, TAUXTVA, NOMIMAGE, QUANTITEENSTOCK, DATEAJOUT, DISPONIBLE'); 
            $this->db->from('produit'); 
            $this->db->like($pRecherche); 
            $this->db->order_by('LIBELLE', 'ASC'); 

            $requete = $this->db->get();
            if ($requete->num_rows() > 0) 
            { // si nombre de lignes > 0
                foreach ($requete->result() as $ligne) {
                $jeuDEnregistrements[] = $ligne;
            }
            return $jeuDEnregistrements;
            } // fin if
            return false;
        } // retournerArticlesLimite

        public function AddCmd($data){
            $this->db->insert('commande', $data);
        }//Fin AddCommande

        public function RetournerNoCommande($LeNum) {
            //SELECT nocommande FROM commande WHERE noclient='1' ORDER BY datecommande DESC LIMIT 1
            $this->db->order_by('nocommande','DESC');
            $requete = $this->db->get_where('commande',array('noclient' => $LeNum),0,1);
            return $requete->row_array();
        }
        
        public function InsertLigne($data) {
            $this->db->insert('ligne', $data);
        }

        public function retournerCommande()
        {
            $requete = $this->db->get('commande');
            return $requete->result_array(); 
        } 

        public function validerCommande($data, $NOCOMMANDE){
            $this->db->update('commande', $data, array ('NOCOMMANDE' => $NOCOMMANDE));
        }
    } // Fin Classe
    