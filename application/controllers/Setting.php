<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$this->load->model('setting_model');
	}

	//-------------------------------------------------------------------------------
	public function change_password()
	{	
		if ($this->input->post('submit')) {

			$user_id = $this->session->userdata('user_id');

			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update_password', $data['errors']);
				redirect(base_url('setting/change_password'),'refresh');

			}else{

				$data = array(
					'id' => $user_id,
					'old_password' => $this->input->post('old_password'),
					'password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),
				);

				$data = $this->security->xss_clean($data); // XSS Clean
				
				$result = $this->setting_model->update_password($data,$user_id);
				
				if($result) {
					$this->session->set_flashdata('update_password_success','User password has been Successfully updated');
					
					redirect(base_url('setting/change_password'));
				}else{
					$this->session->set_flashdata('update_password_failed','Old Password is incorrect');
					redirect(base_url('setting/change_password'));
				}
			}
		}
		else{
			$data['user_sidebar'] = 'themes/jobseeker/user_sidebar'; // load sidebar for user
			$data['title'] = 'Change Password';
			$data['layout'] = 'themes/jobseeker/setting/change_password_page';
			$this->load->view('themes/layout', $data);
		}
	}

}// endClass
