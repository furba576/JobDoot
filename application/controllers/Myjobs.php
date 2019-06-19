<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myjobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
        $this->load->model('myjob_model');
        $this->load->model('common_model');
    }

    //-------------------------------------------------------------------------------
    // Applied Jobs
    public function index()
    {
        $data['jobs'] = $this->myjob_model->get_applied_jobs(); // Fetching Applied jobs

        $data['user_sidebar'] = 'themes/jobseeker/user_sidebar'; // load sidebar for user
        $data['title'] = 'Applied Jobs';
        $data['layout'] = 'themes/jobseeker/my_jobs/applied_job_page';
        $this->load->view('themes/layout', $data);
    }

    //-------------------------------------------------------------------------------
    /**
     * [matching jobs]
     */
    public function matching()
    {
        $user_id = $this->session->userdata('user_id');
        $skills = get_user_skills($user_id); // helper function

        $data['jobs'] = $this->myjob_model->get_matching_jobs($skills);

        $data['user_sidebar'] = 'themes/jobseeker/user_sidebar'; // load sidebar for user
        $data['title'] = 'Matching Jobs';
        $data['layout'] = 'themes/jobseeker/my_jobs/matching_jobs_page';
        $this->load->view('themes/layout', $data);
    }
}// endClass
