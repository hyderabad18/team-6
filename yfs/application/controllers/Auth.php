<?php 

class Auth extends CI_controller
{
    var $site_name;
    var $site_config = array();
	var $data = array();
    var $id;

    function __construct(){
        parent::__construct();
		$this->load->model("volunteer_model");
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
        $this->login_user();
		$this->page_data['title'] = "Home|" . $this->site_name;
		$this->load->view('pages/login', $this->page_data);
    }//index
    public function login(){
        $this->load->view('pages/login');
    }// login
    public function registration() {
		if ($this->session->userdata('is_logged_in'))
			 redirect('home');

		if ($this->register_user()) {
            //redirect("Auth/user_created/");
        	$this->user_created($this->input->post('email'));
			
		} else {
           
			$this->page_data["title"] = "Registration |" . $this->site_name;
		    $this->load->view('pages/registration', $this->page_data);
		}
        //var_dump($this->page_data["departments"]);
	}// registration

    public function user_created($id) {
		$this->page_data["title"] = "Registration Successful |" . $this->site_name;
		$this->page_data["email"] = $id;
		$this->load->view('pages/user_created', $this->page_data);
	}// user_created


    public function register_user(){
        $this->page_data["reg_validation_errors"] = false;
        if(isset($_POST['submit_user'])){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_register_email_check|xss_clean');
			$this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last name', 'trim|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|max_length[15]|callback_register_Phone_check|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[8]|matches[password_re]');
            $this->form_validation->set_rules('password_re', 'password_re', 'required|min_length[8]');
            //$this->form_validation->set_rules('', 'Address', 'trim|required|xss_clean|valid_lat');
           // $this->form_validation->set_rules('longitude', 'Address', 'trim|required|xss_clean|valid_long');
            //if form validation is true
			if ($this->form_validation->run())
			{
               // echo 'form validated';
                // adding user in database
                if($this->volunteer_model->register_user($_POST['password'])){
                   // $this->user_registered_send_mail();
					return true;
                }
            }
            $this->page_data["reg_validation_errors"] = true;
        return false;
        }
        
        return false;
        
    }// register_user

    function register_email_check() {
		$email = $this->input->post('email');
		if ($this->volunteer_model->check_email_exists($email)) {
			$this->form_validation->set_message('register_email_check', 'Email: ' . $email . ' is already registered with ' . $this->site_name);
			return false;
		}
		return true;
	}// register_email_check

	function register_Phone_check() {
		$phone = $this->input->post('phone');
		if ($this->volunteer_model->check_phone_exists($phone)) {
			$this->form_validation->set_message('register_Phone_check', 'Phone: ' . $phone . ' is already registered with ' . $this->site_name);
			return false;
		}
		return true;
	}// register_Phone_check

        public function login_user() {
			if (isset($_POST['submit_login'])) 
			{
				// echo "go this";
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|callback_login_credentials_check');
			if ($this->form_validation->run()) 
			{
				echo "correct";
                $user_data = $this->volunteer_model->get_user_data($this->input->post('email'));
                $session_data = array(
					'user_name' => $user_data['display_name'],
					'volunteer_id' => $user_data['volunteer_id'],
                    'Gender' => $user_data['gender'],
					'phone' => $user_data['phone_no'],
					'firstName' => $user_data['first_name'],
					'lastName' => $user_data['last_name'],
					'email' => $user_data['email'],
                    'is_logged_in' => true
				);
				
                $this->session->set_userdata($session_data);
                redirect('volunteer');
                }
                $this->page_data['error'] = true;
            }  
        } //login user

        function login_credentials_check() {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            if ($this->volunteer_model->check_email_exists($email)) {    
                if ($this->volunteer_model->check_credentials($email, $password)) {
					return true;
				} else {
					$this->form_validation->set_message('login_credentials_check', 'Incorrect password');
					return FALSE;
				}
            }
            else{
                $this->form_validation->set_message('login_credentials_check', 'Email is not registered with ' . $this->site_name);
			return FALSE;
            }
        }

    	public function logout() {
		$this->session->sess_destroy();
		redirect('auth');
	}// logout
    
    function user_registered_send_mail() {
		$this->load->model("helpers/mail_helper");
        	
		$email_page = 'email_templates/user_registered';
		
    	$mail_data = array(
			'to' => $this->input->post('email'),
			'subject' => 'Registration Completed Successfully',
			'message_template' => $email_page,
			'message_data' => array(
				'name' => $this->input->post('firstname'),
				'email' => $this->input->post('email')
			)
		);
		$this->mail_helper->sendMail($mail_data);
	}// user_registered_send_mail

}