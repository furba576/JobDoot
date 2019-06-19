<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Myjob_Model extends CI_Model{

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_applied_jobs()
	{
		$this->db->select('xx_seeker_applied_job.job_id,
			xx_job_post.id,
			xx_job_post.job_title,
			xx_job_post.company_name,
			xx_job_post.job_slug, xx_job_post.job_type,
			xx_job_post.description, xx_job_post.country,
			xx_job_post.city,
			xx_job_post.created_date,
			xx_job_post.industry');
		$this->db->from('xx_seeker_applied_job');
		$this->db->join('xx_job_post', 'xx_seeker_applied_job.job_id = xx_job_post.id', 'left');
		$this->db->where('xx_seeker_applied_job.seeker_id', $this->session->userdata('user_id'));
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//-------------------------------------------------------
	// Get Matching Jobs
	public function get_matching_jobs($skills)
	{
		$this->db->select('id, job_title, company_name, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');


		if(!empty($skills)){
			$skills = explode(',', trim($skills));
			foreach($skills as $skill){
				$this->db->or_like('job_title', $skill);
				$this->db->or_like('skills', $skill);
			}
		}

		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		// $this->db->group_by('job_title');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>