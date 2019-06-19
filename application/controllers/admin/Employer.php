<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/employer_model', 'employer_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
		$this->load->model('common_model', 'common_model');
	}

	//------------------------------------------------
	public function index()
	{
		$this->session->unset_userdata('employer_search_type');
		$this->session->unset_userdata('employer_search_from');
		$this->session->unset_userdata('employer_search_to');
		
		$data['title'] = 'Employer List : OnJob';
		$data['view']  = 'admin/employers/employer_list';
		$this->load->view('admin/layout', $data);	
	}
	
	//-----------------------------------------
	function datatable_json()
	{				   					   
		$records = $this->employer_model->get_all_employers();
        $data = array();
        foreach ($records['data']  as $row) 
		{
			$data[]= array(
				$row['id'],
                $username = $row['firstname'].$row['lastname'],
				$row['email'],
				$row['mobile_no'],
				$row['designation'],
				'<a class="edit btn btn-xs btn-warning" href='.base_url("admin/employer/edit/".$row['id']).' title="Employer Details" > 
				 <i class="fa fa-eye"></i></a>&nbsp;&nbsp;
				 <a class="edit btn btn-xs btn-primary" href='.base_url("admin/employer/edit/".$row['id']).' title="Job Details" > 
				 <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
				 <a class="delete btn btn-xs btn-danger" href='.base_url("admin/employer/del/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> 
				 <i class="fa fa-trash-o"></i></a>'
			);
        }
		$records['data']=$data;
        echo json_encode($records);						   
	}

	//--------------------------------------------------
	function search()
	{
		$this->session->set_userdata('employer_search_type',$this->input->post('employer_search_type'));
		$this->session->set_userdata('employer_search_from',$this->input->post('employer_search_from'));
		$this->session->set_userdata('employer_search_to',$this->input->post('employer_search_to'));
	}

	//-------------------------------------------------------
	public function del($id = 0)
	{
		$this->db->delete('xx_employers', array('id' => $id));
		$this->session->set_flashdata('success', 'Employer has been deleted successfully!');
		redirect(base_url('admin/employer'));
	}
	
}
?>