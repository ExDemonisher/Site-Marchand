<?php
    class ModeleAdmin extends CI_Model 
    {
        public function __construct(){
            $this->load->database();
        }
        public function retournerUneCategorie()
         { $requete = $this->db->get('categorie'); 
            return $requete->result_array(); 
            // retour d'un tableau associatif } // fin retournerArticles
         }
         public function retournerUneMarque()
         { $requete = $this->db->get('marque'); 
            return $requete->result_array(); 
         }
            // retour d'un tableau associatif } // fin retournerArticles

        public function insererUnArticle($pDonneesAInserer) { 
            return $this->db->insert('produit', $pDonneesAInserer); 
        } // insererUnArticle

        public function dispo($donneesaModifier, $NoProduit)
        {
            $this->db->update('produit',$donneesaModifier, array('NOPRODUIT' => $NoProduit));
        }
        public function ModifierUnProduit($donneesaModifier, $NoProduit)
        {   
            $this->db->where('NOPRODUIT', $NoProduit);
            $this->db->update('produit',$donneesaModifier);
        }
    }
    
?>