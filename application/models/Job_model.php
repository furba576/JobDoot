<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Model extends CI_Model{

	//---------------------------------------------------
	// Count total users
	public function count_all_jobs()
	{
		$this->db->where('is_status', 'active');
		return $this->db->count_all('xx_job_post');
	}

	//---------------------------------------------------
	// Count total users
	public function count_all_search_result($search=null)
	{
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		if(!empty($search))
			$this->db->where($search);

		if(!empty($search['job_title'])){
			$search_text = explode('-', $search['job_title']);
			foreach($search_text as $search){
				$this->db->or_like('job_title', $search);
				$this->db->or_like('skills', $search);
			}
		}
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		// $this->db->group_by('job_title');

		$this->db->from('xx_job_post');
		return $this->db->count_all_results();
	}


	//---------------------------------------------------------------------------	
	// Get All Jobs
	public function get_all_jobs($limit, $offset, $search)
	{
		$this->db->select('job_title, id, employer_id ,company_name, job_slug, job_type, description, country, city, created_date, industry, expertise_level');
		$this->db->from('xx_job_post');
		
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		if(!empty($search))
			$this->db->where($search);

		if(!empty($search['job_title'])){
			$search_text = explode('-', $search['job_title']);
			foreach($search_text as $search){
				$this->db->or_like('job_title', $search);
				$this->db->or_like('skills', $search);
			}
		}
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		// $this->db->group_by('job_title');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result_array = $query->result_array();

		foreach( $result_array as &$ra ){
			$logo = $this->get_company_logo( $ra['employer_id'] );
			if( sizeof($logo) == 0 ){
				$ra['company_logo'] = "";
			}else{
				$ra['company_logo'] = $logo[0]['company_logo'];
			}
		}
		return $result_array;
	}

	//---------------------------------------------------------------------------	
	// Get Job detail by ID
	public function get_job_by_id($id)
	{
		$query = $this->db->get_where('xx_job_post', array('id' => $id));
		return $result = $query->row_array();
	}

	//---------------------------------------------------------------------------	
	// Get User Detail by ID
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('xx_users', array('id' => $id));
		return $result = $query->row_array();
	}

	//------------------------------------------------------------------
	// Check the already applied job application
	public function check_applied_application($seeker_id, $job_id)
	{
		$data = array(
			'seeker_id'=> $seeker_id,
			'job_id'=> $job_id
		);
		$query = $this->db->get_where('xx_seeker_applied_job', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	//------------------------------------------------------------------
	// insert job application
	public function insert_job_application($user_id, $emp_id, $job_id, $cover_letter)
	{
		$data = array(
			'seeker_id'=> $user_id,
			'job_id'=> $job_id,
			'employer_id'=> $emp_id,
			'cover_letter'=> $cover_letter,
			'applied_date' => date('Y-m-d : h:m:s')
		);
		$this->db->insert('xx_seeker_applied_job', $data);
		return true;
	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as city_id, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those categories who have jobs
	public function get_categories_with_jobs()
	{
		$this->db->select('category as category_id, COUNT(category) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->group_by('category');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those industries who have jobs
	public function get_industries_with_jobs()
	{
		$this->db->select('industry as industry_id, COUNT(industry) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->group_by('industry');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
		// Class for get Company Logo
		// Dependency function of : get_all_jobs()

	public function get_company_logo( $id )
	{
		$this->db->select('company_logo');
		$this->db->from('xx_companies');
		$this->db->where( 'employer_id', $id );
		$query = $this->db->get();
		return $query->result_array();
	}


} // endClass

?>