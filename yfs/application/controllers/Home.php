<?php

class Home extends CI_Controller
{
    public function login()
    {

    }
    public function register()
    {

    }
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('users/register');
        $this->load->view('templates/footer');

    }
}


?>