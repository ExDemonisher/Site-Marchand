<?php
class ab extends CI_Controller
{
    public function Calcul()
    {
        $this->load->helper('form');
        $this->load->view('addition/Calcul');

    }
    public function Resultat()
    {
        $a=$DonneesInjectees['a'] = $this->input->post('Nombre_a');
        $b=$DonneesInjectees['b'] = $this->input->post('Nombre_b');
        $DonneesInjectees['c'] = $a + $b;
        $this->load->view('addition/Resultat', $DonneesInjectees);
    }

}