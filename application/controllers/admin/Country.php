<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->model('admin/country_model', 'country_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Country List';
		$data['view'] = 'admin/country/country_list';
		$data['countries'] = $this->country_model->get_all_countries();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('country', 'country', 'trim|is_unique[xx_countries.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/country/country_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('country'));
			$data = array(
				'name' => ucfirst($this->input->post('country')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->country_model->add_country($data);
			$this->session->set_flashdata('success','Country has been added successfully');
			redirect(base_url('admin/Country'));
		}
		else{
			$data['title'] = 'Add Country';
			$data['view'] = 'admin/country/country_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('country', 'country', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/country/country_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('country'));
			$data = array(
				'name' => ucfirst($this->input->post('country')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->country_model->edit_country($data, $id);
			$this->session->set_flashdata('success','Country has been updated successfully');
			redirect(base_url('admin/country'));
		}
		else{
			$data['title'] = 'Update Country';
			$data['country'] = $this->country_model->get_country_by_id($id);
			$data['view'] = 'admin/country/country_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('xx_countries', array('id' => $id));
		$this->session->set_flashdata('success', 'Country has been Deleted Successfully!');
		redirect(base_url('admin/country'));
	}

}

?>