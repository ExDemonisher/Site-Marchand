<?php
class Utilisateur extends CI_Controller
{

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
    }

    public function PageDAccueilUtilisateur()
    {
        $this->load->view('Utilisateur/EnteteUtilisateur');
        $this->load->view('Utilisateur/PageDAccueilUtilisateur');
    }
    public function Catalogue()
    {
        $this->load->view('Utilisateur/EnteteUtilisateur');
        $this->load->view("templates/Catalogue");
    }
   

}