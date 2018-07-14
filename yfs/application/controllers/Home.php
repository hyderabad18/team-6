<?php

class Home extends CI_Controller
{
    var $site_name;
	var $site_config = array();
	var $data = array();

    function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model("volunteer_model");
		
		$this->config->load('site_settings', TRUE);

		$this->site_config = $this->config->item('site_settings');
		$this->site_name = $this->site_config['site_name'];
		$this->page_data['site_name'] = $this->site_name;

		header("Cache-Control: private, must-revalidate, max-age=0");
		header("Pragma: no-cache");
		//header("Expires: Fri, 4 Jun 2010 12:00:00 GMT");
	}// __construct

        
        public function login(){
            $this->load->view('users/login');
        }// login
        
        public function index() {
            $this->login_user();
            $this->page_data['title'] = "Home|" . $this->site_name;
            
            $this->load->view('users/login');
        }
    

        public function contactus() {

            $this->page_data['title'] = "ContactUs|" . $this->site_name;
            $this->load->view('home/contactus', $this->page_data);
        }// contactus

        function login_user() {
            if (isset($_POST['submit_login'])) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|callback_login_credentials_check');
                if ($this->form_validation->run()) {
                    $user_data = $this->volunteer_model->get_user_data($this->input->post('email'));
                    $session_data = array(
                        'volunteer_name' => $user_data['DisplayName'],
                        'volunteer_id' => $user_data['volunteer_id'],
                        'Gender' => $user_data['Gender'],
                        'phone' => $user_data['phone_no'],
                        'firstName' => $user_data['FirstName'],
                        'lastName' => $user_data['LastName'],
                        'displayName' => $user_data['display_name'],
                        'email' => $user_data['EmailID'],
                        'location_name' => $user_data['loca_name'],
                        'location_lat' =>$user_data['location_lat'],
                        'location_long' =>$user_data['location_long'],
                        'user_role' =>$user_data['role_flag'],
                        'is_logged_in' => true
                    );
    
                    $this->session->set_userdata($session_data);
                    if($user_data['user_role'] === "1")
                        redirect('Admin');
                    else
                        redirect('profile/home');
                }
                $this->page_data['error'] = true;
            }
        }// login_user



        function login_credentials_check() {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
    
            if ($this->volunteer_model->check_email_exists($email)) {
                if ($this->volunteer_model->check_approved($email)) {
                    if ($this->volunteer_model->check_credentials($email, $password)) {
                        return true;
                    } else {
                        $this->form_validation->set_message('login_credentials_check', 'Incorrect password');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('login_credentials_check', 'User account is not activated. Please check your email for activation link');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('login_credentials_check', 'Email is not registered with ' . $this->site_name);
                return FALSE;
            }
        }// login_credentials_check
    


        public function registration() {
            if ($this->session->userdata('is_logged_in'))
                redirect(profile / home);
    
            if ($this->register_user()) {
                $this->user_created($this->input->post('email'));
                //redirect("home/user_created/");
            } else {
                $this->page_data["title"] = "Registration|" . $this->site_name;
                $this->load->view('users/registration', $this->page_data);
            }
        }// registration


        public function user_created($id) {
            $this->page_data["title"] = "Registration Successful|" . $this->site_name;
            $this->page_data["email"] = $id;
            $this->load->view('pages/user_created', $this->page_data);
        }// user_created



        function register_user() {
            $this->page_data["reg_validation_errors"] = false;
            if (isset($_POST['btn-signup'])) {
                //$this->form_validation->set_rules('text_captcha', 'Captcha', 'trim|required|callback_captcha_check');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_register_email_check|xss_clean');
                $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('lastname', 'Last name', 'trim|xss_clean');
                //$this->form_validation->set_rules('dobyear', 'Date of Birth', 'callback_check_dob');
                $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
    //            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|max_length[15]|xss_clean');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|max_length[15]|callback_register_Phone_check|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[password_re]|xss_clean');
                $this->form_validation->set_rules('password_re', 'Confirm Password', 'trim|required|xss_clean');
                $this->form_validation->set_rules('latitude', 'Address', 'trim|required|xss_clean|valid_lat');
                $this->form_validation->set_rules('longitude', 'Address', 'trim|required|xss_clean|valid_long');
                if ($this->form_validation->run()) {
                    //$key = md5(uniqid());
                    if ($this->volunteer_model->register_user($_POST['password'])) {
                        //$this->user_registered_send_mail();
                        return true;
                    }
                }
                $this->page_data["reg_validation_errors"] = true;
                return false;
            }
            return false;
        }// register_user


        function register_Phone_check() {
            $phone = $this->input->post('phone');
            if ($this->volunteer_model->check_phone_exists($phone)) {
                $this->form_validation->set_message('register_Phone_check', 'Phone: ' . $phone . ' is already registered with ' . $this->site_name);
                return false;
            }
            return true;
        }// register_Phone_check

        
        public function logout() {
            $this->session->sess_destroy();
            redirect('home');
        }// logout

        
        function user_registered_send_mail() {
            $this->load->model("helpers/mail_helper");
            
            $email_page = 'email_templates/user_registered';
            $usrdob = date_create($this->input->post('dobyear') . '/' . $this->input->post('dobmonth') . '/' . $this->input->post('dobday'));
            $presentDate = time();
            $diff = date_diff(date_create(date(DATE_RFC850)),$usrdob);
            $diff = $diff->format("%y");
            if($diff < 17){
                $email_page = 'email_templates/18_below_user_registered';
            }
            
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


?>