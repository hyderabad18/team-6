<?php




class Volunteer extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard');
    }
    public function updateprofile()
    {
        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard');
        $this->load->view('volunteers/updatedetails');
    }
    public function updateddata()
    {
        $this->load->model('volunteer_model');
        $this->volunteer_model->update_data();
    }
}



?>