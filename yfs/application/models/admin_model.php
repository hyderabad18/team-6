<?php

class Admin_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }


    public function get_events_count(){
        $this->db->select("count(event_id) as event_count")
			->from('event');
		$quer = $this->db->get();
		$result = $quer->result();
		return $result[0]->event_count;
    }

    public function get_volunteers_count(){
        $this->db->select("count(volunteer_id) as vlounteer_count")
			->from('volunteer');
		$quer = $this->db->get();
		$result = $quer->result();
		return $result[0]->vlounteer_count;
    }

    public function createEvent($data){
        if($this->db->insert('event',$data))
        echo "successful";
        else
        echo "failed";

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function get_beneficiary_count(){
        $this->db->select("sum(benefit) as benefit_count")
        ->from('event');
        $quer = $this->db->get();
		$result = $quer->result();
		return $result[0]->benefit_count;

    }

    public function acceptVolunteerRequests($vid){
           $this->db->set('status','accepted',false);
           $this->db->where('vid',$vid); 
           $this->db->update('event_enrollments',$data);
           return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getAllEventDetails(){
        $result = $this->db->get('event');
		return $result->result_array();

    }

    public function rejectVolunteerRequests($vid){
        $this->db->set('status','declined',false);
        $this->db->where('vid',$vid); 
        $this->db->update('event_enrollments',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
 }    

    public function updateEvent($event_id){
        $this->db->insert('event',$data)
        ->where('event_id',$event_id);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getVolunteersAssignedForEvent($eve_id){
        $this->db->where('vid',$vid); 
        $result = $this->db->get('event');
    }

}




/**
 * Added By : Manish Kumar Sadhu
 */