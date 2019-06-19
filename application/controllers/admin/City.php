<?php defined('BASEPATH') OR exit('No direct script access allowed');

class city extends MY_Controller
{
	function __construct(){
		parent ::__construct();
		$this->load->model('admin/city_model', 'city_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'city List';
		$data['view'] = 'admin/city/city_list';
		$data['cities'] = $this->city_model->get_all_cities();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('city', 'city', 'trim|is_unique[xx_cities.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/city/city_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('city'));
			$data = array(
				'name' => ucfirst($this->input->post('city')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->city_model->add_city($data);
			$this->session->set_flashdata('success','City has been added successfully');
			redirect(base_url('admin/city'));
		}
		else{
			$data['title'] = 'Add city';
			$data['view'] = 'admin/city/city_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('city', 'city', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/city/city_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('city'));
			$data = array(
				'name' => ucfirst($this->input->post('city')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->city_model->edit_city($data, $id);
			$this->session->set_flashdata('success','City has been updated successfully');
			redirect(base_url('admin/city'));
		}
		else{
			$data['title'] = 'Update city';
			$data['city'] = $this->city_model->get_city_by_id($id);
			$data['view'] = 'admin/city/city_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('xx_cities', array('id' => $id));
		$this->session->set_flashdata('success', 'City has been Deleted Successfully!');
		redirect(base_url('admin/city'));
	}

}

?>