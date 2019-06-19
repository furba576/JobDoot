<?php  defined('BASEPATH') OR exit('No direct script access allowed');
class Cv_Model extends CI_Model{

	public function get_user_profiles($search)
	{
		$this->db->select('*');
		$this->db->from('xx_users');
		
		// search URI parameters
		if(!empty($search['city']))
			$this->db->where('city', $search['city']);

		if(!empty($search['job_title'])){
			$search_text = explode('-', $search['job_title']);
			foreach($search_text as $search){
				$this->db->like('job_title', $search);
				$this->db->or_like('skills', $search);
			}
		}
		$this->db->where('is_active', '1');
		$this->db->where('profile_completed', '1');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('job_title');
		//$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function do_shortlist($emp_id, $user_id)
	{
		$this->db->insert('xx_cv_shortlisted', array('employer_id' => $emp_id, 'user_id' => $user_id));
		return true;
	}

	public function check_if_shortlisted( $emp_id, $user_id ){
		$this->db->select( "*" );
		$this->db->from( 'xx_cv_shortlisted' );
		$this->db->where( array(
			'employer_id' => $emp_id,
			'user_id' => $user_id
		) );
		$result = $this->db->get();

		if( $result->num_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

	public function get_shortlisted_applicants()
	{
		$this->db->select('xx_cv_shortlisted.id, 
			xx_cv_shortlisted.user_id,
			xx_cv_shortlisted.employer_id,
			xx_users.firstname, 
			xx_users.lastname,
			xx_users.email,
			xx_users.city,
			xx_users.country,
			xx_users.job_title,
			xx_users.current_salary,
			xx_users.resume');
		$this->db->from('xx_cv_shortlisted');
		$this->db->join('xx_users','xx_users.id = xx_cv_shortlisted.user_id','left');
		$this->db->where('xx_cv_shortlisted.employer_id', $this->session->userdata('employer_id'));
		$this->db->order_by("xx_cv_shortlisted.created_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}
	
		
} // endClass
?>