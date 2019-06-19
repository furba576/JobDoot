<?php		
class Employer_Model extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	function get_all_employers()
    {
		$wh =array();


		if($this->session->userdata('employer_search_from')!='')
			$wh[]=" `created_date` >= '".date('Y-m-d', strtotime($this->session->userdata('employer_search_from')))."'";

		if($this->session->userdata('employer_search_to')!='')
			$wh[]=" `created_date` <= '".date('Y-m-d', strtotime($this->session->userdata('employer_search_to')))."'";
		
		$SQL ='SELECT * FROM xx_employers';
		
		if(count($wh)>0)
		{
			$WHERE = implode(' and ',$wh);
			return $this->datatable->LoadJson($SQL,$WHERE);
		}
		else
		{
			return $this->datatable->LoadJson($SQL);
		}
    }


    //---------------------------------------------
	function add($data)
	{

		return $this->db->insert('xx_employers',$data);

	}	

	//---------------------------------------------
	function edit($data,$user_id)
	{

		$this->db->where('id', $user_id);
		$this->db->update('xx_employers', $data);

		return true;

	}


	//---------------------------------------------
	function get($id)
	{

		return $this->db->select('*')->from('xx_employers')->where('id',$id)->get()->row_array();

	}


	//---------------------------------------------
	function getEmployersJobs($emp_id)
	{
		$this->db->select('*');
		$this->db->from('employer_job_post');
		$this->db->where('job_status', 'featured');
		$this->db->where('employer_id', $emp_id);
		$this->db->order_by('date','desc');
		$query=$this->db->get();
		return $query->result_array();
	}
	//---------------------------------------------
	function getEmployerDetailbyId($emp_id)
	{
		return  $this->db->get_where('xx_employers', array('id' => $emp_id))->row();
	}
	//---------------------------------------------
	function getEmployerPersonalDetailbyId($emp_id)
	{
		return $this->db->get_where('xx_employer_info', array('company_id' => $emp_id))->row();
	}
	//---------------------------------------------
	function deleteEmployer($eid)
	{
		$this->db->query("DELETE FROM `xx_employers` WHERE id=".$eid."");
		return 1;
	}	

			
}
?>