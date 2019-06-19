<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('common_model');
		$this->load->model('home_extended_model');//added
	}

	//-----------------------------------------------------------------------------
	// Index funciton will call bydefault
	public function index()
	{
		$data['cities'] = $this->common_model->get_cities_list(); // get citities for dropdown
		$data['cities_job'] = $this->home_model->get_cities_with_jobs(); //get those cities who have jobs

		// get job count by expertize level for banner count //block added
		$count = $this->home_extended_model->get_job_count_by_expertise_level();
		foreach( $count as &$c ){
			$c['num'] = ceil( (int)$c['num'] / 10 ) * 10;
		}
		$data['job_count'] = $count;

		// get combined categories and job_count on each combined category //block added
		$combined_categories = $this->home_extended_model->get_category_by_expertise_level();
		foreach( $combined_categories as &$cc ){
			$cc['jobs_count'] = $this->home_extended_model->count_jobs_by_combined_category( $cc['el_id'], $cc['id'] );
		}
		$data['combined_categories'] = $combined_categories;

		$data['jobs'] = $this->home_extended_model->get_jobs(8,0);

		$data['companies'] =  $this->home_model->get_companies_logo(8,0);

		$data['title'] = 'Home';
		$data['layout'] = 'themes/home';
		$this->load->view('themes/layout', $data);
	}


	//-----------------------------------------------------------------------------
	// About Us Page
	public function about_us()
	{
		$data['title'] = 'About';
		$data['layout'] = 'themes/about_us';
		$this->load->view('themes/layout', $data);
	}

	//-----------------------------------------------------------------------------
	// Contact Us Functionality
	public function contact()
	{
		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('username','first name','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]');
			$this->form_validation->set_rules('subject','last name','trim|required|min_length[3]');
			$this->form_validation->set_rules('message','message','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_send', $data['errors']);

				redirect(base_url('contact'),'refresh');
			}
			else
			{
				$data = array(
					'username' => $this->input->post('first_name'),
					'email' => $this->input->post('email'),
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->home_model->contact($data);

				if ($result)
				{
					$this->session->set_flashdata('success','<p class="alert alert-success"><strong>Success! </strong>your message has been sent successfully!</p>');
					redirect(base_url('contact'), 'refresh');
				}
				else
				{
					redirect(base_url('contact'), 'refresh');
				}
			}
		}
		else
		{
			$data['title'] = 'Contact';
			$data['layout'] = 'themes/contact_us';
			$this->load->view('themes/layout', $data);
		}
	}

}// endClass
