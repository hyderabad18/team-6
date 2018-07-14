<?php




class Volunteer extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard');
        $this->load->view('templates/footer');
    }
}



?>