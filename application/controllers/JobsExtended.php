<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('Jobs.php');

class JobsExtended extends Jobs
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('job_extended_model');
    }

    //--------------------------------------------------------------
    // Jobs by expertise level
    public function jobs_by_expertise_level()
    {
        $data['categories'] = $this->job_model->get_categories_with_jobs();
        $data['title'] = 'Jobs by Categories';
        $data['layout'] = 'themes/jobseeker/jobs/jobs_category_page';
        $this->load->view('themes/layout', $data);
    }

    //--------------------------------------------------------------
    // search job by expertise level

    public function expertise_level($title)
    {
        $search['expertise_level'] = get_expertise_level_id($title); // get expertise_level_id(el_id)  by title

        // pagination
        $count  = $this->job_model->count_all_search_result($search);
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $url    = base_url("jobs/category/".$title);

        $config = $this->functions->pagination_config($url, $count, $this->per_page_record);
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        $data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

        $data['categories'] = $this->common_model->get_categories_list();
        $data['cities'] = $this->common_model->get_cities_list();

        $data['title'] = 'Category';

        $data['subtitle'] = make_title($title)." Jobs";
        $data['layout'] = 'themes/jobseeker/jobs/job_list_page';
        $this->load->view('themes/layout', $data);
    }


    // search job by Combined Category

    public function get_jobs_by_combined_category($expertise_level, $category)
    {
        $search['expertise_level'] = get_expertise_level_id($expertise_level); // get el_id by title
        $search['category'] = get_category_id($category); //get category id by title

        // pagination
        $count  = $this->job_model->count_all_search_result($search);
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $url    = base_url("JobsExtended/get_jobs_by_combined_category/".$expertise_level.'/'.$category);

        $config = $this->functions->pagination_config($url, $count, $this->per_page_record);
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);

        $data['jobs']       = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);
        $data['categories'] = $this->common_model->get_categories_list();
        $data['cities']     = $this->common_model->get_cities_list();
        $category_id        = get_category_id($category);
        $data['subtitle']   = get_category_name($category_id)." Jobs";
        $data['title']      = 'Jobs by Category';
        $data['layout']     = 'themes/jobseeker/jobs/job_list_page';
        $this->load->view('themes/layout', $data);
    }


    //Advanced Filter Search

    public function advanceSearch()
    {
        if ($this->input->post('search')) {
            $expertise_level = $this->input->post('expertise_level');
            $category = $this->input->post('category');
            $job_type = $this->input->post('job_type');
            $experience = $this->input->post('experience');

            $query = "";
            $search_array = array();
            $search_terms = array();

            if (!empty($expertise_level)) {
                $i = 0;
                foreach ($expertise_level as $el) {
                    $search_array['expertise_level'][$i] = get_expertise_level_id($el);
                    $search_terms['expertise_level'][$i] = $el;
                    if ($i == 0):
                        $query .= " expertise_level = '".get_expertise_level_id($el)."'"; else:
                        $query .= " OR expertise_level = '".get_expertise_level_id($el)."'";
                    endif;
                    $i++;
                }
            }

            if (!empty($category)) {
                $i = 0;
                foreach ($category as $el) {
                    $search_array['category'][$i] = $el;
                    $search_terms['category'][$i] = $el;

                    if ($i == 0):
                        $query .= " category = '". $el ."'"; else:
                        $query .= " OR category = '". $el ."'";
                    endif;
                    $i ++;
                }
            }

            if (!empty($job_type)) {
                $i = 0;
                foreach ($job_type as $el) {
                    $search_array['job_type'][$i] = $el;
                    $search_terms['job_type'][$i] = $el;

                    if ($i == 0):
                        $query .= " job_type = '". $el ."'"; else:
                        $query .= " OR job_type = '". $el ."'";
                    endif;
                    $i ++;
                }
            }

            if (!empty($experience)) {
                $i = 0;
                foreach ($experience as $el) {
                    $search_array['experience'][$i] = $el;
                    $search_terms['experience'][$i] = $el;

                    if ($i == 0):
                        $query .= " experience = '". $el ."'"; else:
                        $query .= " OR experience = '". $el ."'";
                    endif;
                    $i ++;
                }
            }

            if (empty($query) || $query == "") {
                redirect(base_url('jobs/search'));
                return;
            }

            $search_query = $query;
            $pg_arr = $this->pagination_assoc('p', 3); // private function
            $count = $this->job_extended_model->count_as_results($search_array);
            $offset = $pg_arr['offset'];
            $url= base_url("jobs/search/".$pg_arr['uri']);
            $config = $this->functions->pagination_config($url, $count, $this->per_page_record);
            $config['uri_segment'] = $pg_arr['seg'];

            $this->pagination->initialize($config);

            $data['search_value'] = $search_terms; //previous value was $search_array
            $data['jobs'] = $this->job_extended_model->get_all_jobss($this->per_page_record, $offset, $search_array);
            $data['cities'] = $this->common_model->get_cities_list();
            $data['categories'] = $this->common_model->get_categories_list();

            $data['title'] = 'Search Result';
            $data['layout'] = 'themes/jobseeker/jobs/job_list_page';
            $this->load->view('themes/layout', $data);
        }
    }



    //---------------------------------------------------------------------
    // Pagination Association function
    private function pagination_assoc($varkey, $assoc_n)
    {
        $qs_arr = $this->uri->uri_to_assoc($assoc_n);
        $qs_tmp_arr = array();

        foreach ($qs_arr as $key => $value) {
            if ($key != $varkey) {
                $qs_tmp_arr[$key] = $value;
                $assoc_n = 0;
            }
        }

        foreach ($this->uri->segment_array() as $key => $value) {
            if ($value == 'p') {
                $assoc_n = $key;
            }
        }

        $offset = (isset($qs_arr [$varkey]))? $qs_arr[$varkey]: 0;

        $qs_uri = $this->uri->assoc_to_uri($qs_tmp_arr). '/'. $varkey;

        $arr = array(
            'offset' => $offset,
            'seg' => $assoc_n + 1,
            'uri' => $qs_uri
        );

        return $arr;
    }
}// endClass
