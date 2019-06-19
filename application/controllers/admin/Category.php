<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends MY_Controller
{ 
	function __construct(){
		parent ::__construct();
		$this->load->model('admin/category_model', 'category_model');
	}

	//-----------------------------------------------------
	public function index()
	{
		$data['title'] = 'Category List';
		$data['view'] = 'admin/category/category-list';
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('admin/layout', $data);
	}

	//-----------------------------------------------------
	public function add()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|is_unique[xx_categories.name]|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/category/category_add';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->category_model->add_category($data);
			$this->session->set_flashdata('success','category has been added successfully');
			redirect(base_url('admin/category'));
		}
		else{
			$data['title'] = 'Add Category';
			$data['view'] = 'admin/category/category_add';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function edit($id=0)
	{
		if($this->input->post()){
			$this->form_validation->set_rules('category', 'Category', 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			if ($this->form_validation->run() === FALSE) {
				$data['view'] = 'admin/category/category_edit';
				$this->load->view('admin/layout', $data);
				return;
			}

			$slug = make_slug($this->input->post('category'));
			$data = array(
				'name' => ucfirst($this->input->post('category')),
				'slug' => $slug
			);
			$data = $this->security->xss_clean($data);
			$result = $this->category_model->edit_category($data, $id);
			$this->session->set_flashdata('success','category has been updated successfully');
			redirect(base_url('admin/category'));
		}
		else{
			$data['title'] = 'Update Category';
			$data['category'] = $this->category_model->get_category_by_id($id);
			$data['view'] = 'admin/category/category_edit';
			$this->load->view('admin/layout', $data);
		}
	}

	//-----------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('xx_categories', array('id' => $id));
		$this->session->set_flashdata('success', 'category has been Deleted Successfully!');
		redirect(base_url('admin/category'));
	}


	//----------------------------------------------------------
	// category by expertise level
	public function category_by_expertise_level( $expertlevel_id = "1" ){

		$el_id = "";

		$el_id = $this->input->post("expertise_level")? $this->input->post("expertise_level") : $expertlevel_id;
		

		if( $this->input->post('add_cat') ){
			$selected_lists = $this->input->post('other_cat');

			if( isset($selected_lists) ){

				foreach ($selected_lists as $item) {
					# code...
					$data['el_id'] = $el_id;
					$data['cat_id'] = get_category_id( $item );
					$this->category_model->addToCombinedCategory( $data );
				}

				redirect( current_url().'/'.$el_id , "refresh");

			}
		}

		if( $this->input->post('remove_cat') ){
			
			$selected_lists = $this->input->post('current_cat');

			if( isset($selected_lists) ){

				foreach ($selected_lists as $item) {
					# code...
					$data['el_id'] = $el_id;
					$data['cat_id'] = get_category_id( $item );
					$this->category_model->removeFromCombinedCategory( $data );
				}
				redirect( current_url().'/'.$el_id , "refresh");

			}

		}

		$categories = $this->category_model->get_all_categories();
		$categories_of_el = $this->category_model->get_categories_of_expertise_level( $el_id );
		$cat_not_in_el = array();

		foreach( $categories as $cat ){
			$match = FALSE;
			foreach( $categories_of_el as $cat_o_el ){
				if( $cat['id'] == $cat_o_el['id'] ){
					$match = TRUE;
				}
			}

			if( $match == FALSE ){
				array_push( $cat_not_in_el, $cat );
			}
		}
		
		$data['expertise_level'] = $this->category_model->get_expertise_level();
		$data['category_of_el'] = $categories_of_el;
		$data['other_categories'] = $cat_not_in_el;

		$data['selected_el_id'] = $el_id;

		$data['title'] = 'Categories by Expertise Level';
		$data['view'] = 'admin/category/category-by-expertise-level';
		
		
		
		$this->load->view('admin/layout', $data);

	}

}
?>