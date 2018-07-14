<?php

class volunteer_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }


    function register_user()
    {
        $userdata = array(
            'created_on' => date('Y-m-d H:i:s'),
            'email' => $this->input->post('email'),
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
			'display_name' => $this->input->post('firstname').' '.$this->input->post('lastname'),
			'gender' => $this->input->post('gender'),
            'password' => md5($pwd),
            'phone_no' => $this->input->post('phone'),
            //'UserStatusFlag' => 1,
			
            //'Zipcode' => $this->input->post('zipcode'),
            'loc_lat' => '10.100',
            'loc_long' => '10.10000',
        );
        $this->db->insert('volunteer', $userdata);
		$insert_id = $this->db->insert_id();
		//$this->db->query("INSERT INTO sll_users_log SELECT null, su.* FROM sll_users su WHERE su.UserID='$insert_id'");
        return ($this->db->affected_rows() != 1) ? false : true;
    } // function to insert volunteer data into voulnteer table


    function check_credentials($EmailID, $password)
    {
        $this->db->where('email', "$EmailID");
        $this->db->where('password', md5($password));
        $query = $this->db->get('volunteer');
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    } 


    public function get_user_data($EmailID){
        $this->db->where('email', "$EmailID");
        $query = $this->db->get('volunteer');
        return $query->row_array();
    }// function to get details of the user


    public function check_email_exists($EmailID)
    {
        $this->db->where('email', "$EmailID");
        $query = $this->db->get('volunteer');
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    }  // function to check whether the mail already exists

    public function check_phone_exists($Phone)
    {
		$query = $this->db->query("SELECT * FROM volunteer WHERE phone_no=$Phone");
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    }  // function to check whether the mobile number already exists 


    public updatedata($data)
    {

        $this->db->set();
        $user_email=$this->session->userdata('email');
        $this->db->where('email',$user_email);
        if($this->db->update('volunteer',$data)==FALSE)
        {
            //update failed 
        }
        else
        {

        }



    }

}