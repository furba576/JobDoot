<?php defined('BASEPATH') OR exit('No direct script access allowed');

// require('Job_model.php');

class Job_Extended_Model extends Job_Model{


	public function __construct()
	{
		parent::__construct();
	}


	//---------------------------------------------------------------------------	
	// Get All Jobs
	public function get_all_jobs($limit, $offset, $search)
	{
		$this->db->select('id, job_title, employer_id ,company_name, job_slug, job_type, description, country, city, created_date, industry, expertise_level');
		$this->db->from('xx_job_post');
		
		// search URI parameters
		//unset($search['p']); //unset pagination parameter form search
		if(!empty($search))
			$this->db->where($search);

		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('job_title');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();
		$result_array = $query->result_array();

		foreach( $result_array as &$ra ){
			$logo = $this->get_company_logo( $ra['employer_id'] );
			if( sizeof($logo) == 0 ){
				$ra['company_logo'] = "";
			}else{
				$ra['company_logo'] = $logo[0]['company_logo'];
			}
		}
		return $result_array;
	}


	public function get_all_jobss( $limit, $offset, $search ){
		$this->db->select('id, job_title, employer_id ,company_name, job_slug, job_type, description, country, city, created_date, industry, expertise_level');
		$this->db->from('xx_job_post');

		if( !empty( $search ) ){

			$i = 0;
			foreach( $search as $s_cat => $val ){
				$query = "";
				$j = 0;

				$size = sizeof($val) - 1;
				$title = $s_cat;
				foreach ( $val as $sc ){
					if( $j == 0 ):
						$query .= " ".$title." = '".$sc."'";
					else:
						$query .= " OR ".$title." = '".$sc."'";
					endif;

					$j++;
				}
				$i++;

				$this->db->where( "(".$query.")" );
			}
		}

		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('job_title');
		$this->db->limit($limit, $offset);

		// var_dump( $this->db->get_compiled_select());
		// die();
		$result = $this->db->get();
		$result_array = $result->result_array();

		foreach( $result_array as &$ra ){
			$logo = $this->get_company_logo( $ra['employer_id'] );
			if( sizeof($logo) == 0 ){
				$ra['company_logo'] = "";
			}else{
				$ra['company_logo'] = $logo[0]['company_logo'];
			}
		}
		return $result_array;
		
	}





	//count advance search results
	public function count_as_results( $search ){

		if( !empty( $search ) ){

			$i = 0;
			foreach( $search as $s_cat => $val ){
				$query = "";
				$j = 0;

				$size = sizeof($val) - 1;
				$title = $s_cat;
				foreach ( $val as $sc ){
					if( $j == 0 ):
						$query .= " ".$title." = '".$sc."'";
					else:
						$query .= " OR ".$title." = '".$sc."'";
					endif;

					$j++;
				}
				$i++;

				$this->db->where( "(".$query.")" );
			}
		}
		$this->db->from('xx_job_post');
		return $this->db->count_all_results();
	}

} //end class