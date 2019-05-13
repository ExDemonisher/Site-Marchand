<?php
    class ModeleVisiteur extends CI_Model 
    {
        public function __construct(){
            $this->load->database();
        }

        public function existe($pUtilisateur) // non utilisée retour 1 si connecté, 0 sinon
        {
            $this->db->where($pUtilisateur);
            $this->db->from('client');
            return $this->db->count_all_results(); // nombre de ligne retournées par la requeête
        } // existe

        public function AjoutUtilisateur($donneesAInserer)
        {
            return $this->db->insert('client', $donneesAInserer);
        }

        public function insererUnClient($donneesAInserer)
        {
            return $this->db->insert('client', $donneesAInserer);
        }

        public function retournerNomProfil($Utilisateur)
        {
            $requete = $this->db->get_where('client',$Utilisateur);
            return $requete->row(); // retour d'une seule ligne 
            // retour sous forme d'objets
        }     

    }
    
?>