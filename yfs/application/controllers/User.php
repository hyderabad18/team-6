<?php

class User extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('users/login');
        $this->load->view('templates/footer');
    }
}
?>