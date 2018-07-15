<?php




class Volunteer extends CI_Controller
{
    public function index()
    {
        $this->load->model('volunteer_model');

        $data['eve']=$this->volunteer_model->getevents();
        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard',$data);
    }
    public function updateprofile()
    {
        $this->load->model('volunteer_model');
        $data['eve']=$this->volunteer_model->getevents();
        $this->load->model('volunteer_model');

        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard',$data);
        $this->load->view('volunteers/updatedetails');
    }
    public function updateddata()
    {
        $this->load->model('volunteer_model');
        $data['eve']=$this->volunteer_model->getevents();
        // $this->load->model('volunteer_model');
        $this->volunteer_model->update_data();
    }
    public function updateTemp($event_temp)
    {
        $event_name=$this->input->post('event_name');
        $this->load->model('volunteer_model');
        $this->volunteer_model->update_temp($event_temp);
        redirect('volunteer');
    }

    public function checkins()
    {
        $this->load->model('volunteer_model');
        $data['eve']=$this->volunteer_model->getCheckIn ();
        $this->load->model('volunteer_model');
        $this->load->view('templates/header');
        $this->load->view('volunteers/dashboard_checkin',$data);
    }
    public function update_check($event_temp)
    {
        // $event_name=$this->input->post('event_name');
        $this->load->model('volunteer_model');
        $this->volunteer_model->update_check($event_temp);
        redirect('volunteer/checkins');
    }
}



?>