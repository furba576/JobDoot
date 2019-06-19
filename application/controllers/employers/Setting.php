<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->model('employers/setting_model', 'setting_model');
	}

	//-------------------------------------------------------------------------------
	public function change_password()
	{	
		if ($this->input->post('submit')) {

			$emp_id = $this->session->userdata('employer_id');

			$this->form_validation->set_rules('old_password','old password','trim|required|min_length[3]');
			$this->form_validation->set_rules('new_password','new password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirm_password','confirm password','trim|required|min_length[3]|matches[new_password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_update_password', $data['errors']);
				redirect(base_url('employers/setting/change_password'),'refresh');

			}else{

				$data = array(
					'id' => $emp_id,
					'old_password' => $this->input->post('old_password'),
					'password' => password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),
				);

				$result = $this->setting_model->update_password($data,$emp_id);
				
				if($result) {
					$this->session->set_flashdata('update_password_success','Password has been Successfully updated');
					
					redirect(base_url('employers/setting/change_password'));
				}else{
					$this->session->set_flashdata('update_password_failed','Old Password is incorrect');
					redirect(base_url('employers/setting/change_password'));
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'themes/employers/emp_sidebar'; // load sidebar for user
			$data['layout'] = 'themes/employers/setting/change_password_page';
			$this->load->view('themes/layout', $data);
		}
	}

}// endClass
