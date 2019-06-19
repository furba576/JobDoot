<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Model extends CI_Model{

	//----------------------------------------------------
	// Get all companies
	public function get_companies()
	{
		$this->db->select('company_name, company_slug, company_logo');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get all companies
	public function get_company_detail($id)
	{
		$query = $this->db->get_where('xx_companies', array('id' => $id));
		return $query->row_array();
	}

	//----------------------------------------------------
	// Get all companies
	public function get_jobs_by_companies($company_id)
	{
		$this->db->select('id, job_title, company_name, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('company_id', $company_id);
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

}

?>