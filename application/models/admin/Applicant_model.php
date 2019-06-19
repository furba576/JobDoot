<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant_Model extends CI_Model{

	//----------------------------------------------------------------------
	// Get Applied who had applied jobs
	public function get_applicants($job_id)
	{

		$this->db->select('xx_seeker_applied_job.id, 
			xx_seeker_applied_job.job_id,
			xx_seeker_applied_job.applied_date as apply_date, 
			xx_users.firstname, 
			xx_users.lastname, 
			xx_users.job_title, 
			xx_users.email, 
			xx_users.category,
			xx_users.city,   
			xx_users.country, 
			xx_users.resume,
			xx_seeker_applied_job.*');
		$this->db->from('xx_seeker_applied_job');
		$this->db->join('xx_users','xx_users.id = xx_seeker_applied_job.seeker_id','left');
		$this->db->where(' xx_seeker_applied_job.job_id',$job_id); 
		$this->db->order_by("xx_seeker_applied_job.applied_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Get Shortlisted candidates
	public function get_shortlisted_applicants($job_id)
	{
		$this->db->select('xx_seeker_applied_job.id, 
			xx_seeker_applied_job.applied_date as apply_date,
			xx_users.firstname, xx_users.lastname,
			xx_users.email,
			xx_users.city,
			xx_users.country,
			xx_users.category,
			xx_users.job_title,
			xx_users.current_salary,
			xx_users.resume,
			xx_seeker_applied_job.*');
		$this->db->from('xx_seeker_applied_job');
		$this->db->join('xx_users','xx_users.id = xx_seeker_applied_job.seeker_id','left');
		$this->db->where(' xx_seeker_applied_job.job_id',$job_id); 
		$this->db->where(' xx_seeker_applied_job.is_shortlisted',1); 
		$this->db->order_by("xx_seeker_applied_job.applied_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Interviewed Applicants
	public function get_interviewed_applicants($job_id)
	{
		$this->db->select('xx_seeker_applied_job.id,
		 	xx_seeker_applied_job.applied_date as apply_date,
		 	xx_users.firstname, 
		 	xx_users.lastname, 
		 	xx_users.email, 
		 	xx_users.category,
		 	xx_users.city, 
		 	xx_users.resume,
		 	xx_seeker_applied_job.*');
		$this->db->from('xx_seeker_applied_job');
		$this->db->join('xx_users','xx_users.id = xx_seeker_applied_job.seeker_id','left');
		$this->db->where(' xx_seeker_applied_job.job_id',$job_id); 
		$this->db->where(' xx_seeker_applied_job.is_interviewed',1); 
		$this->db->order_by("xx_seeker_applied_job.applied_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Shortlist
	public function do_shortlist($id)
	{
		$this->db->where('id', $id);
		$this->db->update('xx_seeker_applied_job', array('is_shortlisted' => 1));
		return true;
	}


	}//end class

?>