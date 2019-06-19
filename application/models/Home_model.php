<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Model extends CI_Model{

	//-------------------------------------------------------------------
    // contant us 
	public function contact($data)
	{
		$this->db->insert('xx_contact_us',$data);
		return true;
	}

	//-------------------------------------------------------------------
	// Get jobs for home page
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, job_title, company_name, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as name, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get companies logos for home page
	public function get_companies_logo()
	{
		$this->db->select('company_slug, company_logo, company_name');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>