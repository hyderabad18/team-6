<?php

class User extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function register_user($pwd)
    {
        $fromDate = date("Y-m-d H:i:s", strtotime("-3 months"));
        $userdata = array(
            'CreatedOn' => date('Y-m-d H:i:s'),
            'EmailID' => $this->input->post('email'),
            'FirstName' => $this->input->post('firstname'),
            'LastName' => $this->input->post('lastname'),
			'DisplayName' => $this->input->post('firstname').' '.$this->input->post('lastname'),
			'Gender' => $this->input->post('gender'),
            'Password' => md5($pwd),
            'Phone' => $this->input->post('phone'),
            'UserStatusFlag' => 1,
            'UserVerifiedFlag' => 1,
            'BloodgroupID' => $this->input->post('bloodgroup'),
            'LastBloodDonatedOn' => date('Y-m-d', strtotime("-3 months")),
			'Locality' => $this->input->post('address'),
            'City' => $this->input->post('city'),
            'State' => $this->input->post('state'),
            'Country' => $this->input->post('country'),
            'Zipcode' => $this->input->post('zipcode'),
            'BaseLat' => $this->input->post('latitude'),
            'BaseLong' => $this->input->post('longitude'),
	    "AvailabilityDate" 		=> date('Y-m-d H:i:s'),
	    "AvailabilityStatusID" 	=> 1,
        );
        $this->db->insert('volunteer', $userdata);
		$insert_id = $this->db->insert_id();
		//$this->db->query("INSERT INTO sll_users_log SELECT null, su.* FROM sll_users su WHERE su.UserID='$insert_id'");
        return ($this->db->affected_rows() != 1) ? false : true;
    } // function to insert volunteer data into voulnteer table
    


    function check_credentials($EmailID, $password)
    {
        $this->db->where('EmailID', "$EmailID");
        $this->db->where('Password', md5($password));
        $query = $this->db->get('volunteer');
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    } // function to validate the credentials


    public function get_user_data($EmailID){
        $this->db->where('EmailID', "$EmailID");
        $query = $this->db->get('volunteer');
        return $query->row_array();
    }// function to get details of the user


    public function check_email_exists($EmailID)
    {
        $this->db->where('EmailID', "$EmailID");
        $query = $this->db->get('volunteer');
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    }  // function to check whether the mail already exists

    public function check_phone_exists($Phone)
    {
		$query = $this->db->query("SELECT * FROM volunteer WHERE Phone=$Phone");
        if ($query->num_rows() == 1)
            return true;
        else
            return false;
    }  // function to check whether the mobile number already exists 


    public updatedata($data)
    {
        $this->db->update

    }

}