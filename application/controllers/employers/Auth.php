<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('employers/auth_model','auth_model');
		$this->load->model('common_model'); // load common model 
		$this->load->library('mailer'); // load custom mailer library
	}

	//------------------------------------------------------------------
	public function login(){
		if ($this->input->post('login')) {

			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_login', $data['errors']);
				// redirect(base_url('employers/auth/login'),'refresh');
			}else{

				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data);
				$result = $this->auth_model->login($data);

				if ($result) {
					$login_data = array(
						'employer_id' => $result['id'],
						'email' => $result['email'], 
						'password' => $result['password'],
						'username' => $result['firstname'],
						'is_employer_login' => TRUE
					);

					$this->session->set_userdata($login_data);
					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page'))){
						$back_to = $this->session->userdata('last_request_page');
						redirect($back_to);
					}
					else{
						redirect(base_url('employers/profile'),'refresh');
					}
				}else{
					$this->session->set_flashdata('error_login','invalid email or password');
					// redirect(base_url('employers/auth/login'),'refresh');
				}
			}
		}

		$data['title'] = 'Employer Login';
		$data['layout'] = 'themes/employers/auth/login_page';
		$this->load->view('themes/layout', $data);
	}

	//------------------------------------------------------------------
	public function registration()
	{
		 

		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[7]|valid_email|is_unique[xx_employers.email]',
				array(
					'is_unique' => 'Email is already registered in our system.'
				)
			);
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('company_name','Company Name','trim|required|min_length[3]');
			$this->form_validation->set_rules('org_type','Organization Type','trim|required');
			$this->form_validation->set_rules('country','Country','trim|required');
			$this->form_validation->set_rules('city','City','trim|required');
			$this->form_validation->set_rules('address','Address','trim|required|min_length[3]');
			$this->form_validation->set_rules('phone_no','Phone Number','trim|required');
			$this->form_validation->set_rules('website','website','trim|required');
			$this->form_validation->set_rules('description','Company Description','trim|required|min_length[5]');

			$this->form_validation->set_rules('termsncondition','terms n condition','required', 
				array( 
					'required' => 'Accept our Terms and Conditions to Continue.'
				 )
			);

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				// redirect(base_url('employers/auth/registration'));
			}else{

				$emp_info = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$company_info = array(
					'company_name' => $this->input->post('company_name'), 
					'company_slug' => make_slug($this->input->post('company_name')),
					'org_type' => $this->input->post('org_type'),
					'address' => $this->input->post('address'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'phone_no' => $this->input->post('phone_no'),
					'website' => $this->input->post('website'),
					'description' => $this->input->post('description'),
				);

				$emp_info = $this->security->xss_clean($emp_info);
				$emp_id = $this->auth_model->insert_employers($emp_info); // Insert Employer Info & get ID

				$company_info['employer_id'] = $emp_id;
				$company_info = $this->security->xss_clean($company_info);
				$result = $this->auth_model->insert_company($company_info); // Insert Company Info
				
				if ($result) {
					$this->session->set_flashdata('registration_success','<p class="alert alert-success">Registration has been done successfully. Please login in below</p>');
					redirect(base_url('employers/auth/login'), 'refresh');
				}else{
					echo "failed";
				}
			}
		}
		// else{
			$data['categories'] = $this->common_model->get_categories_list(); 
			$data['countries'] = $this->common_model->get_countries_list(); 
			$data['cities'] = $this->common_model->get_cities_list();

			$data['title'] = 'Employer Registration';
			$data['layout'] = 'themes/employers/auth/registration_page';
			$this->load->view('themes/layout', $data);
		// }
	}

	//--------------------------------------------------		
	public function forgot_password()
	{
		if($this->input->post('submit')){
			//checking server side validation
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('employers/auth/forgot_password'));
			}
			$email = $this->input->post('email');

			$response = $this->auth_model->check_emp_mail($email); // check if email exist
			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email
				$name = $response['firstname'].' '.$response['lastname'];
				$email = $response['email'];
				$reset_link = base_url('employers/auth/reset_password/'.$pwd_reset_code);
				$body = $this->mailer->pwd_reset_link($name,$reset_link);

				$this->load->helper('email_helper');
				$to = $email;
				$subject = 'Reset your password';
				$message =  $body ;
				$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
				if($email){
					$this->session->set_flashdata('success', 'We have sent instructions for resetting your password to your email');

					redirect(base_url('employers/auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', 'There is the problem on your email');
					redirect(base_url('employers/auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'The Email that you provided are invalid');
				redirect(base_url('employers/auth/forgot_password'));
			}
		}
		else{
			$data['title'] = 'Forget Password';
			$data['layout'] = 'themes/employers/auth/forget_password_page';
			$this->load->view('themes/layout', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
		// check the activation code in database
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'themes/employers/auth/reset_password_page';
				$this->load->view('themes/layout', $data);
			}   
			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success','New password has been Updated successfully.Please login below');
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);
			if($result){
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'themes/employers/auth/reset_password_page';
				$this->load->view('themes/layout', $data);
			}
			else{
				$this->session->set_flashdata('error','Password Reset Code is either invalid or expired.');
				redirect(base_url('themes/employers/auth/forgot_password'));
			}
		}
	}

 	//------------------------------------------------------------------
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('employers/home'), 'refresh');
	}

}// end classs

?>