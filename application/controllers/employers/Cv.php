<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('employers/cv_model','cv_model');
		$this->load->model('common_model');
	}

	//--------------------------------------------------------------------------------------
	public function search(){

		$data['cities'] = $this->common_model->get_cities_list(); 

		if($this->input->post('search'))
		{
			if( empty( $this->input->post('job_title' ) ) ){
				redirect(base_url('employers/cv/search/'),'refresh');
			}else{

				// search job title, keyword
				if(!empty($this->input->post('job_title')))
					$search['job_title'] = make_slug($this->input->post('job_title'));

				// search job city
				if(!empty($this->input->post('city')))
					$search['city'] = $this->input->post('city');

				$query = $this->uri->assoc_to_uri($search);

				redirect(base_url('employers/cv/search/'.$query),'refresh');
			}

		}
		$search_array = $this->uri->uri_to_assoc(4);

		$data['search_value'] = $search_array;
		$data['profiles'] = $this->cv_model->get_user_profiles($search_array);

		$data['title'] = 'CV Search Result';
		$data['layout'] = 'themes/employers/cv_search/cv_search_page';
		$this->load->view('themes/layout', $data);

	}

	//--------------------------------------------------------
	// Shortlist Resume
	public function make_shortlist($user_id)
	{
		$emp_id = $this->session->userdata('employer_id');

		if( $this->cv_model->check_if_shortlisted( $emp_id, $user_id ) === FALSE ){
			$result = $this->cv_model->do_shortlist($emp_id, $user_id);
			if($result){
				redirect(base_url('employers/cv/shortlisted'), 'refresh');
			}
		}else{
			redirect(base_url('employers/cv/shortlisted'), 'refresh');
		}

		
	}

	//-----------------------------------------------------------------------------------------
	// Shortlisted Applicant
	public function shortlisted(){

		$data['applicants'] = $this->cv_model->get_shortlisted_applicants(); 

		$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for employer
		$data['title'] = 'Shortlisted Applicants';
		$data['layout'] = 'themes/employers/applicants/shortlisted_applicants_page';
		$this->load->view('themes/layout',$data);
	}

}

?> 