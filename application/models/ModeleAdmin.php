<?php
    class ModeleAdmin extends CI_Model 
    {
        public function __construct(){
            $this->load->database();
        }
        public function retournerCategorie($data)
        {   
            $requete= $this->db->get_where('categorie', array("LIBELLE" => $data));
            return $requete->row();
        }
        public function retournerMarque($dataMarque)
        {
            $requete= $this->db->get_where('marque', array("NOM" =>$dataMarque));
            return $requete->row();
        }
        public function AjouterUnProduit($donneesAInserer)
        {
            return $this->db->insert('produit', $donneesAInserer);
        } 
        public function dispo($donneesaModifier, $NoProduit)
        {
            $this->db->update('produit',$donneesaModifier, array('NOPRODUIT' => $NoProduit));
        }
        public function ModifierUnProduit($donneesaModifier, $NoProduit)
        {
            $this->db->update('produit',$donneesaModifier, array('NOPRODUIT' => $NoProduit));
        }
    }
    
?>