<?php
class Job_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	//-----------------------------------------------------
	function GetAll()
    {
		$wh =array();
		
		if($this->session->userdata('job_search_industry') != '')
			$wh[]=" xx_job_post.industry = '".$this->session->userdata('job_search_industry')."'";
		if($this->session->userdata('job_search_category') != '')
			$wh[]=" xx_job_post.category = '".$this->session->userdata('job_search_category')."'";
		if($this->session->userdata('job_search_location')!= '')
			$wh[]=" xx_job_post.country = '".$this->session->userdata('job_search_location')."'";
		
		if($this->session->userdata('job_search_from') != '')
			$wh[]=" xx_job_post.created_date >= '".date('Y-m-d', strtotime($this->session->userdata('job_search_from')))."'";
		if($this->session->userdata('job_search_to') != '')
			$wh[]=" xx_job_post.created_date <= '".date('Y-m-d', strtotime($this->session->userdata('job_search_to')))."'";
			
		$SQL ='SELECT
				xx_job_post.*, 
				Count(xx_seeker_applied_job.seeker_id) as cand_applied, 
				SUM(CASE WHEN xx_seeker_applied_job.is_shortlisted > 0 THEN 1 ELSE 0 END) as total_shortlisted,
				SUM(CASE WHEN xx_seeker_applied_job.is_interviewed > 0 THEN 1 ELSE 0 END) as total_interviewed
				FROM
				  xx_job_post left Join  xx_seeker_applied_job 
				  On xx_seeker_applied_job.job_id = xx_job_post.id';  
				  
		$wh[] = 'admin_id = '.$this->session->userdata('admin_id');	
	
		$GROUP_BY =' GROUP BY xx_job_post.id ';  

		if(count($wh)>0)
		{
			$WHERE = implode(' and ',$wh);
			return $this->datatable->LoadJson($SQL,$WHERE,$GROUP_BY);
		}
		else
		{
			return $this->datatable->LoadJson($SQL,'',$GROUP_BY);
		}
    }
	
	//---------------------------------------------------------------------
	// Add new Job
	function add_job($data)
	{
		$this->db->insert('xx_job_post', $data);
		return $this->db->insert_id();
	}

	//----------------------------------------------------------------------
	// Edit Job
	public function edit_job($data,$job_id,$admin_id){
		$this->db->where('id',$job_id);
		$this->db->where('admin_id',$admin_id);
		$this->db->update('xx_job_post',$data);
		return true;
	}
	
	//----------------------------------------------------------------------
	// Get job by ID
	public function get_job_by_id($job_id,$admin_id){
		$query = $this->db->get_where('xx_job_post', array('id' => $job_id , 'admin_id' => $admin_id ));
		return $result = $query->row_array();
	}

} //endClass
?>