<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends MY_Controller
{
	function __construct()
	{
		parent ::__construct();
		$this->load->model('admin/industry_model', 'industry_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Industry List';
		$data['view'] = 'admin/industry/industry_list';
		$data['industries'] = $this->industry_model->get_all_industries();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('industry', 'Industry', 'trim|is_unique[xx_industries.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/industry/industry_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('industry'));
			$data = array(
				'name' => ucfirst($this->input->post('industry')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->industry_model->add_industry($data);
			$this->session->set_flashdata('success','Industry has been added successfully');
			redirect(base_url('admin/industry'));
		}
		else{
			$data['title'] = 'Add Industry';
			$data['view'] = 'admin/industry/industry_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('industry', 'Industry', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/industry/industry_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('industry'));
			$data = array(
				'name' => ucfirst($this->input->post('industry')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->industry_model->edit_industry($data, $id);
			$this->session->set_flashdata('success','Industry has been updated successfully');
			redirect(base_url('admin/industry'));
		}
		else{
			$data['title'] = 'Update Industry';
			$data['industry'] = $this->industry_model->get_industry_by_id($id);
			$data['view'] = 'admin/industry/industry_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('xx_industries', array('id' => $id));
		$this->session->set_flashdata('success', 'Industry has been Deleted Successfully!');
		redirect(base_url('admin/industry'));
	}

}

?>