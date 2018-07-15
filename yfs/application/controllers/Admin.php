<?php 

class Admin extends CI_controller
{
    var $site_name;
    var $site_config = array();
	var $data = array();
    var $id;

    public function __construct(){
        parent::__construct();
		$this->load->model("admin_model");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->config->load('site_settings', TRUE);

		$this->site_config = $this->config->item('site_settings');
		$this->site_name = $this->site_config['site_name'];
		$this->page_data['site_name'] = $this->site_name;

    }

    public function index()
    {
        $title ="Admin Dashboard";
        $this->load->view('templates/header',$title);
        $this->load->view('templates/left_nav');
        $page_data['events_count'] = $this->admin_model->get_events_count();
        $page_data['volunteers_count'] = $this->admin_model->get_volunteers_count();
        $page_data['beneficiary_count'] = $this->admin_model->get_beneficiary_count();
        
        $this->load->view('pages/admin_dashboard', $page_data);
    }
    public function createEventPage()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/left_nav');
        $this->load->view('pages/create_event');
        
    }
    public function createEvent()
    {
        // print_r("yo");
        //  print_r($this->session->userdata());
        if($this->session->userdata('role')==1)
        {
            $eventData = array();
            $eventData['event_name']= $this->input->post('event_name');
            $eventData['Event_Description']= $this->input->post('description');
            $eventData['type']= $this->input->post('type');
            $eventData['vol_count']= $this->input->post('volcount');
            $eventData['benefit']= $this->input->post('bno');
            $eventData['loc_name']= $this->input->post('location');
            $eventData['start_date']= $this->input->post('startdate');
            $eventData['end_date']= $this->input->post('enddate');
            $eventData['loc_lat']='10.00';
            $eventData['loc_long']='10.00';
            // print_r($eventData);

            $this->admin_model->createEvent($eventData);
            require('sms.php');
            redirect('admin');
            }
    }



    public function updateEvent($event_id)
    {
        if($this->session->session_data['role']==1)
        {
            $update_event = array();
            $update_event['event_name']= $this->input->post('event_name');
            $update_event['Event_Description']= $this->input->post('event_description');
            $update_event['type']= $this->input->post('event_type');
            $update_event['vol_count']= $this->input->post('vol_count');
            $update_event['benefit']= $this->input->post('benefit_count');
            $update_event['loc_name']= $this->input->post('location_name');
            $update_event['benefit']= $this->input->post('benefit_count');
            $update_event['start_date']= $this->input->post('start_date');
            $update_event['end_date']= $this->input->post('end_date');
            if($this->admin_model->updateEvent($update_event)== 'true')
            {
                $this->sendUpdateEventDetailsMail();
            }
        }
    }

    public function acceptVolunteerRequests($vid)
    {
       $status =  $this->admin_model->acceptVolunteerRequests($vid);
       return $status;
    }// returning status to acknowlege the user

    public function rejectVolunteerRequests($vid)
    {
        $status= $this->admin_model->rejectVolunteerRequests($vid);
    }// returning status to acknowlege the user

    public function Mail_to_volunteers_accpeted()
    {

        $this->load->model("helpers/mail_helper");
		
		$email_page = 'email_templates/acceptedRequestsTemplate';
		
		
		$mail_data = array(
			'to' => $this->input->post('email'),
			'subject' => 'Accepted  the request for volunteering',
			'message_template' => $email_page,
			'message_data' => array(
				'name' => $this->input->post('firstname'),
				'email' => $this->input->post('email')
			)
		);
		$this->mail_helper->sendMail($mail_data);

    }
    


    public function Mail_to_volunteers_rejected()
    {

        $this->load->model("helpers/mail_helper");
		
		$email_page = 'email_templates/requestDeclinedTemplate';
		
		
		$mail_data = array(
			'to' => $this->input->post('email'),
			'subject' => 'Volunnteer Request Declined',
			'message_template' => $email_page,
			'message_data' => array(
				'name' => $this->input->post('firstname'),
				'email' => $this->input->post('email')
			)
		);
		$this->mail_helper->sendMail($mail_data);

    }

    public function getVolunteersAssignedForEvent($eve_id)
    {
        $volunteer_for_event = $this->admin_model->getVolunteersAssignedForEvent();
        $page_data['volunteer_for_event'] =  $volunteer_for_event;
    }

    public function sendUpdateEventDetailsMail()
    {
        $this->load->model("helpers/mail_helper");
		
		$email_page = 'email_templates/UpdatedEventDetails';
		
		
		$mail_data = array(
           'UpdatedFields' =>$this->admin_model->get_updated_event_details(),
			'to' => $this->input->post('email'),
			'subject' => 'Updated the event schedule',
			'message_template' => $email_page,
			'message_data' => array(
				'name' => $this->input->post('firstname'),
				'email' => $this->input->post('email')
			)
		);
		$this->mail_helper->sendMail($mail_data);
    }
    

    public function getAllEventDetails(){
        $AllEvents = $this->admin_model->getAllEventDetails();
        $page_data['AllEvents']=$AllEvents;
    }
}
?>