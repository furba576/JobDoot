<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('company_model');
		$this->load->model('common_model'); // load common model
	}

	//----------------------------------------------------------------------------------
	// All Companies
	public function index()
	{
		$data['companies'] = $this->company_model->get_companies();
		$data['title']     = 'Top Companies';
		$data['layout']    = 'themes/jobseeker/company/companies_page';
		$this->load->view('themes/layout', $data);
	}

	//----------------------------------------------------------------------------------
	/**
	 * [detail ( company detail )]
	 * @param  [company name] $title
	 * @return [array]        [company detail]
	 */
	public function detail($title)
	{
		$company_id           = get_company_id($title);
		$data['company_info'] = $this->company_model->get_company_detail($company_id);
		$data['jobs']         = $this->company_model->get_jobs_by_companies($company_id); // Get company jobs
		$data['title']        = 'Company Detail';
		$data['layout']       = 'themes/jobseeker/company/company_detail_page';
		$this->load->view('themes/layout', $data);
	}
}
?>
