<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
        $this->load->model('profile_model');
        $this->load->model('common_model');
    }

    //-----------------------------------------------------------------------------------
    // Update User Profile Functionality
    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        if ($this->input->post('update')) {
            $this->form_validation->set_rules('firstname', 'firstname', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('lastname', 'lastname', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[7]|valid_email');
            $this->form_validation->set_rules('dob', 'date of birth', 'trim|min_length[3]');
            $this->form_validation->set_rules('mobile_no', 'mobile no', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim');
            $this->form_validation->set_rules('category', 'category', 'trim|min_length[1]');
            $this->form_validation->set_rules('job_title', 'job title', 'trim|min_length[3]');
            $this->form_validation->set_rules('description', 'description', 'trim');
            $this->form_validation->set_rules('country', 'country', 'trim');
            $this->form_validation->set_rules('city', 'city', 'trim');
            $this->form_validation->set_rules('postcode', 'postcode', 'trim|min_length[3]');
            $this->form_validation->set_rules('address', 'address', 'trim|min_length[3]');
            $this->form_validation->set_rules('experience', 'experience', 'trim');
            $this->form_validation->set_rules('skills', 'skills', 'trim');
            $this->form_validation->set_rules('age', 'age', 'trim');
            $this->form_validation->set_rules('current_salary', 'current salary', 'trim');
            $this->form_validation->set_rules('expected_salary', 'expected salary', 'trim');
            $this->form_validation->set_rules('education_level', 'education level', 'trim');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('error_update', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'dob' => $this->input->post('dob'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'nationality' => $this->input->post('nationality'),
                    'category' => $this->input->post('category'),
                    'job_title' => $this->input->post('job_title'),
                    'description' => $this->input->post('description'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'postcode' => $this->input->post('postcode'),
                    'address' => $this->input->post('address'),
                    'experience' => $this->input->post('experience'),
                    'age' => $this->input->post('age'),
                    'current_salary' => $this->input->post('current_salary'),
                    'expected_salary' => $this->input->post('expected_salary'),
                    'education_level' => $this->input->post('education_level'),
                    'skills' => $this->input->post('skills'),
                    'profile_completed' => 1,
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                // upload resume
                if (!empty($_FILES["userfile"]['name'])) {
                    $config = array(
                        'upload_path' => "./uploads/resume/",
                        'allowed_types' => "docx|doc|pdf",
                        'overwrite' => true,
                        'max_size' => "500", // Can be set to particular file size , here it is 0.5 MB(548 Kb)
                        );

                    $new_name = time().$_FILES["userfile"]['name'];
                    $config['file_name'] = $new_name;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload()) {
                        $file_data = array('upload_data' => $this->upload->data());
                        $data['resume'] =  'uploads/resume/'. $file_data['upload_data']['file_name'];
                    } else {
                        $data['file_error'] = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('file_error', $this->upload->display_errors());
                        redirect(base_url('profile'));
                    }
                } else {
                    $data['resume'] = $this->input->post('old_resume');
                }
                //end resume upload code

                $data = $this->security->xss_clean($data); // XSS Clean

                $result = $this->profile_model->update_user($data, $user_id);

                if ($result) {
                    $this->session->set_userdata('username', $data['firstname']);
                    $this->session->set_flashdata('update_success', 'Profile has been  updated successfully');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $data['categories'] = $this->common_model->get_categories_list();
            $data['countries'] = $this->common_model->get_countries_list();
            $data['cities'] = $this->common_model->get_cities_list();
            $data['salaries'] = $this->common_model->get_salary_list();
            $data['educations'] = $this->common_model->get_education_list();
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);

            $data['user_sidebar'] = 'themes/jobseeker/user_sidebar'; // load sidebar for user
            $data['title'] = 'Profile';
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }

    //-----------------------------------------------------------------------------------
    public function experience()
    {
        if ($this->input->post('update_experience')) {
            $user_id = $this->session->userdata('user_id');

            $this->form_validation->set_rules('job_title', 'job title', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('company', 'company', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('country', 'country', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('city', 'city', 'trim|min_length[3]');
            $this->form_validation->set_rules('starting_month', 'starting month', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('starting_year', 'starting_year', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('ending_month', 'ending month', 'trim|min_length[3]');
            $this->form_validation->set_rules('ending_year', 'ending_year', 'trim|min_length[3]');
            $this->form_validation->set_rules('currently_working_here', 'currently_working_here', 'trim');
            $this->form_validation->set_rules('description', 'description', 'trim|min_length[50]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('error_update_experience', $data['errors']);

                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'job_title' => $this->input->post('job_title'),
                    'company' => $this->input->post('company'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'starting_month' => $this->input->post('starting_month'),
                    'starting_year' => $this->input->post('starting_year'),
                    'ending_month' => $this->input->post('ending_month'),
                    'ending_year' => $this->input->post('ending_year'),
                    'currently_working_here' => $this->input->post('currently_working_here'),
                    'description' => $this->input->post('description'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                $result = $this->profile_model->update_experience($data, $user_id);
                if ($result) {
                    $this->session->set_flashdata('update_experience_success', 'user experience has been Successfully updated');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }




    public function education()
    {
        if ($this->input->post('update_education')) {
            $user_id = $this->session->userdata('user_id');

            $this->form_validation->set_rules('degree', 'degree level', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('degree_title', 'degree title', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('major_subjects', 'major subjects', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('country', 'country', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('city', 'city', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('institution', 'institution', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('completion_year', 'completion year', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('result_type', 'result type', 'trim|required|min_length[3]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' =>validation_errors()
                );

                $this->session->set_flashdata('error_update_education', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'degree' => $this->input->post('degree'),
                    'degree_title' => $this->input->post('degree_title'),
                    'major_subjects' => $this->input->post('major_subjects'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'institution' => $this->input->post('institution'),
                    'completion_year' => $this->input->post('completion_year'),
                    'result_type' => $this->input->post('result_type'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                $result = $this->profile_model->update_education($data, $user_id);
                if ($result) {
                    $this->session->set_flashdata('update_education_success', 'user education has been Successfully updated');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }




    public function skill()
    {
        if ($this->input->post('update_skill')) {
            $user_id = $this->session->userdata('user_id');
            $this->form_validation->set_rules('new_skill', 'new skill', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('experience', 'experience', 'trim|required|min_length[3]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' =>validation_errors()
                );

                $this->session->set_flashdata('error_update_skill', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'new_skill' => $this->input->post('new_skill'),
                    'experience' => $this->input->post('experience'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                $result = $this->profile_model->update_skill($data, $user_id);

                if ($result) {
                    $this->session->set_flashdata('update_skill_success', 'user skill has been Successfully updated');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }



    public function summary()
    {
        if ($this->input->post('update_summary')) {
            $user_id = $this->session->userdata('user_id');
            $this->form_validation->set_rules('summary', 'summary', 'trim|required|min_length[20]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' =>validation_errors()
                );

                $this->session->set_flashdata('error_update_summary', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'summary' => $this->input->post('summary'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                $result = $this->profile_model->update_summary($data, $user_id);

                if ($result) {
                    $this->session->set_flashdata('update_summary_success', 'user summary has been Successfully updated');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }



    public function language()
    {
        if ($this->input->post('update_language')) {
            $user_id = $this->session->userdata('user_id');

            $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('proficiency_with_this_language', 'proficiency with this language', 'trim|required|min_length[3]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' =>validation_errors()
                );

                $this->session->set_flashdata('error_update_language', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'user_id' => $user_id,
                    'language' => $this->input->post('language'),
                    'proficiency' => $this->input->post('proficiency_with_this_language'),
                    'updated_date' => date('Y-m-d : h:m:s')
                );

                $result = $this->profile_model->update_languages($data, $user_id);

                if ($result) {
                    $this->session->set_flashdata('update_language_success', 'user language has been Successfully updated');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/profile/user_profile_page';
            $this->load->view('themes/layout', $data);
        }
    }



    public function change_password()
    {
        if ($this->input->post('update_password')) {
            $user_id = $this->session->userdata('user_id');

            $this->form_validation->set_rules('old_password', 'old password', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('new_password', 'new password', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|required|min_length[3]|matches[new_password]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'errors' => validation_errors()
                );

                $this->session->set_flashdata('error_update_password', $data['errors']);
                redirect(base_url('profile'), 'refresh');
            } else {
                $data = array(
                    'id' => $user_id,
                    'old_password' => $this->input->post('old_password'),
                    'password' => $this->input->post('new_password'),
                );

                $result = $this->profile_model->update_password($data, $user_id);

                if ($result) {
                    $this->session->set_flashdata('update_password_success', 'user password has been Successfully updated');

                    redirect(base_url('profile'));
                } else {
                    $this->session->set_flashdata('update_password_failed', 'Old Password is incorrect');
                    redirect(base_url('profile'));
                }
            }
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['user_info'] = $this->profile_model->get_user_by_id($user_id);
            $data['layout'] = 'themes/jobseeker/change password';
            $this->load->view('themes/layout', $data);
        }
    }



    public function update_profile_image()
    {
        $image_base64 = $this->input->post('img');

        $details['imageName'] = uniqid().'.png';
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_base64));
        $path = './uploads/profile_pics/';
        file_put_contents($path.$details['imageName'], $data);

        $final_path = './uploads/profile_pics/'.$details['imageName'];

        $id = $this->session->userdata('user_id');

        if ($this->profile_model->update_profile_pic($final_path, $id)) {
            $this->session->userdata['pro_pic'] = $final_path;
            $this->session->set_flashdata('update_success', 'Profile Image updated successfully');
        }
        echo $image_base64;
    }
}
