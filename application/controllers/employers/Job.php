<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->model('employers/job_model');
		$this->load->model('common_model'); // load common model 
	}

	//---------------------------------------------------------------------------------------
	public function post(){

		$emp_id = $this->session->userdata('employer_id');
		

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('job_type','job type','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('expertise_level','Expertise Level','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('experience','experience','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
			$this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('total_positions','total positions','trim|required');
			$this->form_validation->set_rules('gender','gender','trim|required');
			$this->form_validation->set_rules('employment_type','employment type','trim|required');
			$this->form_validation->set_rules('education','education','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('post_job_error',$data['errors']);
				// redirect(base_url('employers/job/post'),'refresh');

			}else{
				$data = array(
					'employer_id' => $emp_id,
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'job_title' => $this->input->post('job_title'),
					'company_name' => get_company_name_by_employer($emp_id), // helper function
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('experience'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => date('Y-m-d H:i:s')
				);
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'), $job_id);
				$data['expertise_level'] = get_expertise_level_id( $this->input->post('expertise_level') );

				$data = $this->security->xss_clean($data);
				$result = $this->job_model->add_job($data);

				if ($result){
					$this->session->set_flashdata('post_job_success','Congratulation! Job has been Posted successfully');
					redirect(base_url('employers/job/post'));
				}
				else{
					echo "failed";
				}
			}
		}
		// else{
			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['industries'] = $this->common_model->get_industries_list();
			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['cities'] = $this->common_model->get_cities_list(); 
			$data['salaries'] = $this->common_model->get_salary_list();  
			$data['educations'] = $this->common_model->get_education_list();
			$data['expertise_level'] = $this->common_model->get_expertise_level_list();


			$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for employer
			$data['title'] = 'Post New Job';
			$data['layout'] = 'themes/employers/jobs/post_job_page';
			$this->load->view('themes/layout', $data);
		// }
	}

	public function listing()
	{
		$emp_id = $this->session->userdata('employer_id');

		$data['job_info'] = $this->job_model->get_all_jobs($emp_id);

		$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for employer
		$data['title'] = 'Job Listing';
		$data['layout'] = 'themes/employers/jobs/job_listing_page';
		$this->load->view('themes/layout', $data);
	}

	//-----------------------------------------------------------------------------------------
	public function edit($job_id=0)
	{
		$emp_id = $this->session->userdata('employer_id');

		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['industries'] = $this->common_model->get_industries_list();
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 
		$data['salaries'] = $this->common_model->get_salary_list();  
		$data['educations'] = $this->common_model->get_education_list();

		if ($this->input->post('edit_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('job_type','job type','trim|required|min_length[3]');
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('experience','experience','trim|required');
			$this->form_validation->set_rules('min_salary','min salary','trim|required');
			$this->form_validation->set_rules('max_salary','max salary','trim|required');
			$this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('total_positions','total positions','trim|required');
			$this->form_validation->set_rules('gender','gender','trim|required');
			$this->form_validation->set_rules('employment_type','employment type','trim|required');
			$this->form_validation->set_rules('education','education','trim|required');
			$this->form_validation->set_rules('country','country','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('edit_job_error',$data['errors']);
				redirect(base_url('employers/job/edit/'.$job_id),'refresh');

			}
			else{
				$data = array(
					'employer_id' => $emp_id,
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'job_title' => $this->input->post('job_title'),
					'company_name' => get_company_name_by_employer($emp_id), // helper function
					'job_type' => $this->input->post('job_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('experience'),
					'min_salary' => $this->input->post('min_salary'),
					'max_salary' => $this->input->post('max_salary'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'updated_date' => date('Y-m-d H:i:s')
				);
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'), $job_id);


				$data = $this->security->xss_clean($data);
				$result = $this->job_model->edit_job($data,$job_id,$emp_id);

				if ($result) {
					$this->session->set_flashdata('update_success','Congratulation! Job has been Updated successfully');
					redirect(base_url('employers/job/listing'));
				}else{
					echo "failed";
				}
			}
		}
		else{
			$emp_id = $emp_id;
			$data['job_detail'] = $this->job_model->get_job_by_id($job_id,$emp_id);

			$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for employer
			$data['title'] = 'Edit Job';
			$data['layout'] = 'themes/employers/jobs/edit_job_page';
			$this->load->view('themes/layout', $data);
		}
	}

	//-----------------------------------------------------------------------------------------
	public function delete($id=0)
	{
		$emp_id = $this->session->userdata('employer_id');
		
		$this->db->where('id',$id);
		$this->db->where('employer_id',$emp_id);
		$this->db->delete('xx_job_post');
		$this->session->set_flashdata('deleted','Congratulation! Job has been Deleted successfully');
		redirect(base_url('employers/job/listing'));

	}

	//-----------------------------------------------------------------------------------------
	// make job slugon
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}



}// endclass
