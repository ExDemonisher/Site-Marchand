<?php
    class ModeleVisiteur extends CI_Model 
    {
        public function __construct(){
            $this->load->database();
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
    