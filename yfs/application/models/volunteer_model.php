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
        print_r($this->input->post());
        echo "hello";           
    }
    


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