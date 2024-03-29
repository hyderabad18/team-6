<?php

class volunteer_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }


    function register_user($pwd)
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
    
    
    function getUserLocation($vid)
    {
		$query = sprintf("select loc_lat, loc_long from volunteer where volunteer_id='$vid' ");
		$result = $this->db->query($query);
		return $result->result();

    }
    public function getevents()
    {
        //  print_r("select event_id,event_name,loc_name from event where start_date>'".date('Y-m-d')."' and event_id not in (select event_id from temp_event where volunteer_id=".$this->session->userdata('volunteer_id').');');
        $query=$this->db->query("select event_id,event_name,loc_name from event where start_date>'".date('Y-m-d')."' and event_id not in (select event_id from temp_event where volunteer_id=".$this->session->userdata('volunteer_id').');');
        // print_r($query->result_array());
        return $query->result_array();
    }


    public function update_data()
    {
        $pref=$this->input->post('preferences');
        $lat=$this->input->post('latitude');
        $long=$this->input->post('longitude');
        $email=$this->session->userdata('first_name');
        $k='';
        foreach($pref as $m)
        {
            $k=$k.' '.$m;

        }
        print_r($this->session->userdata());
        $data=array('preferences'=>$k,'loc_lat'=>$lat,'loc_long'=>$long);

        print_r($data);
        $this->db->set($data);
        $this->db->where('email',$email);
        if($this->db->update('volunteer',$data)==FALSE)
        {
              echo "fail";
            //  redirect('volunteer');
        }
        else
        {
            //redirect('volunteer');
             echo "success";
        }
    }
    public function update_temp($event)
    {
        // print_r("insert into temp_event(volunteer_id,event_id) values('".$this->session->userdata('email')."',".$event."');");
        $query=$this->db->query("insert into temp_event(volunteer_id,event_id) values(".$this->session->userdata('volunteer_id').",".$event.");");
        // print_r($query);
        // return json_encode($query);
    }

    public function getCheckIn()
    {
        $q="select event_id,event_name,loc_name from event_enrollment natural join event where volunteer_id=".$this->session->userdata('volunteer_id')." and '".date('Y-m-d')."' between start_date and end_date;";
        $query=$this->db->query($q);
        return $query->result_array();
    }
    

    public function update_check($event)
    {
        $q="insert into v_checkin(volunteer_id,event_id,date,checkin) values(".$this->session->userdata('volunteer_id').",".$event.",'".date('Y-m-d')."','".date('Y-m-d h:i:s')."');";
        $query=$this->db->query($q);
    }







}
?>