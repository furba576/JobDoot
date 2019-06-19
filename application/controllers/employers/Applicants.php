<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicants extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('employers/applicant_model', 'applicant_model');
		$this->load->model('common_model'); // load common model 
		$this->load->library('mailer'); // load CI email library
	}

	//-----------------------------------------------------------------------------------------
	// Applicants who have applied for the job
	public function view($job_id){

		$data['applicants'] = $this->applicant_model->get_applicants($job_id); 

		$data['title'] = 'Jobs Applicants';
		$data['layout'] = 'themes/employers/applicants/job_applicants_page';
		$this->load->view('themes/layout',$data);
	}

	//-----------------------------------------------------------------------------------------
	// Make Shortlist Applicant
	public function make_shortlist($id){

		$result = $this->applicant_model->do_shortlist($id); 

		$job_id = $this->uri->segment(5);

		if($result){
			redirect(base_url('employers/applicants/shortlisted/'.$job_id), 'refresh');
		}
	}

	//-----------------------------------------------------------------------------------------
	// Shortlisted Applicant
	public function shortlisted($job_id){

		$data['applicants']=$this->applicant_model->get_shortlisted_applicants($job_id); 

		$data['title'] = 'Shortlisted Applicants';
		$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for employer
		$data['layout'] = 'themes/employers/applicants/shortlisted_applicants_page';
		$this->load->view('themes/layout',$data);
	}

	//-----------------------------------------------------------------------------------------
	// Sending Email to applicant
	public function email()
	{
		$email = trim($this->input->post('email'));
		$title = trim($this->input->post('subject'));
		$message = trim($this->input->post('message'));

		$this->load->helper('email_helper');

		$to = $email;
		$subject = 'Interview Message | OnJob Portal';
		$message =  '<p>Subject: '.$title.'</p>
		<p>Message: '.$message.'</p>' ;

		$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
		
		if(trim($email)=='success'){
			echo 'Email has been sent successfully';
		}else {
			echo 'There is a problem while sending email';
		}
	}


}//endClass