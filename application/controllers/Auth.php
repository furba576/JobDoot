<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->library('google');
		$this->load->library('mailer'); // load custom mailer library
	}

	//-------------------------------------------------------------------
	// login functionality
	public function login()
	{
		if ($this->input->post('login')) 
		{
			$this->form_validation->set_rules('email','email','trim|required|min_length[3]|valid_email' );
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('error_login', $data['errors']);
				// redirect(base_url('auth/login'),'refresh');
			}
			else {
				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password') 
				);

				$data = $this->security->xss_clean($data); // XSS Clean

				$result = $this->auth_model->login($data);

				if ($result) {
					$login_data = array(
						'user_id' => $result['id'],
						'email' => $result['email'], 
						'password' => $result['password'],
						'username' => $result['firstname'],
						'pro_pic' => $result['profile_pic_url'],
						'is_user_login' => TRUE
					);

					$this->session->set_userdata($login_data);

					// redirected to last request page
					if(!empty($this->session->userdata('last_request_page'))) {
						$back_to = $this->session->userdata('last_request_page');
						redirect($back_to);
					}
					else{
						redirect(base_url('profile'),'refresh');
					}
				}
				else {
					$this->session->set_flashdata('error_login','invalid email or password');
				 	// redirect(base_url('auth/login'),'refresh');
				}
			}
		}
		// else
		// {
			$data['title'] = 'Login';
			$data['layout'] = 'themes/auth/login_page';
			$this->load->view('themes/layout', $data);
		// }
	}

	//-------------------------------------------------------------------------------
	// Registration Functionality
	public function registration()
	{
		if ($this->input->post('submit')) 
		{
			$this->form_validation->set_rules('firstname','firstname','trim|required|min_length[3]');
			$this->form_validation->set_rules('lastname','lastname','trim|required|min_length[3]');
			$this->form_validation->set_rules('email','email','trim|required|min_length[5]|valid_email|is_unique[xx_users.email]',
				array(
					'is_unique' => 'Email is already registered in our system.'
				)
			);
			$this->form_validation->set_rules('password','password','trim|required|min_length[3]');
			$this->form_validation->set_rules('confirmpassword','confirm password','trim|required|min_length[3]|matches[password]');
			$this->form_validation->set_rules('termsncondition','terms n condition','required', array( 'required' => 'You need to accept our terms and conditions before continue.' ));

			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('validation_errors', $data['errors']);
				// redirect(base_url('auth/registration'));
				
			}
			else
			{
				$data = array(
					'firstname' => $this->input->post('firstname'), 
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data); // XSS Clean Data

				$result = $this->auth_model->insert_into_users($data);

				if ($result) 
				{
					$this->session->set_flashdata('registration_success','<p class="alert alert-success">you are successfully registerd! Please login below</p>');
					redirect(base_url('auth/login'), 'refresh');
				}
			}
		}
		// else
		// {
			$data['title'] = 'Registration';
			$data['layout'] = 'themes/auth/registration_page';
			$this->load->view('themes/layout', $data, 'refresh');
		// }
	}

	//--------------------------------------------------		
	public function forgot_password()
	{
		if($this->input->post('submit')){
			//checking server side validation
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors(), 
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/forgot_password'));
			}
			$email = $this->input->post('email');

			$response = $this->auth_model->check_user_mail($email); // check if email exist
			if($response){
				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['id']);

				// --- sending email
				$name = $response['firstname'].' '.$response['lastname'];
				$email = $response['email'];
				$reset_link = base_url('auth/reset_password/'.$pwd_reset_code);
				$body = $this->mailer->pwd_reset_link($name,$reset_link);

				$this->load->helper('email_helper');
				$to = $email;
				$subject = 'Reset your password';
				$message =  $body ;
				$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
				if($email){
					$this->session->set_flashdata('success', 'We have sent instructions for resetting your password to your email');

					redirect(base_url('auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', 'There is the problem on your email');
					redirect(base_url('auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'The Email that you provided are invalid');
				redirect(base_url('auth/forgot_password'));
			}
		}
		else{
			$data['title'] = 'Forget Password';
			$data['layout'] = 'themes/auth/forget_password_page';
			$this->load->view('themes/layout', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0)
	{
		// check the activation code in database
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$result = false;
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'themes/auth/reset_password_page';
				$this->load->view('themes/layout', $data);
			}   
			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success','New password has been Updated successfully.Please login below');
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);
			if($result){
				$data['reset_code'] = $id;
				$data['title'] = 'Reseat Password';
				$data['layout'] = 'themes/auth/reset_password_page';
				$this->load->view('themes/layout', $data);
			}
			else{
				$this->session->set_flashdata('error','Password Reset Code is either invalid or expired.');
				redirect(base_url('themes/auth/forgot_password'));
			}
		}
	}

	//----------------------------------------------------------------------------
	// Logout Function
	public function logout()
	{
		 $this->facebook->destroy_session();
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}



	//----------------------------------------------------------------------------
	// Facebook Login
	public function fbLogin(){
        $userData = array();
        
        // Check if user is logged in
        if( $this->facebook->is_authenticated() ) {

            // Get user facebook profile details
            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid']    = !empty($fbUser['id'])?$fbUser['id']:'';;
            $userData['firstname']    = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
            $userData['lastname']    = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
            $userData['email']        = !empty($fbUser['email'])?$fbUser['email']:'';
            $userData['gender']        = !empty($fbUser['gender'])?$fbUser['gender']:'';
            $userData['profile_pic_url']    = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            // $userData['link']        = !empty($fbUser['link'])?$fbUser['link']:'';

            
            // Insert or update user data
            $userID = $this->auth_model->checkUser($userData);
            
            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $login_data = $userData;
                $login_data['username'] = $userData['firstname'];
                $login_data['user_id'] = $userID;
                $login_data['pro_pic'] = $userData['profile_pic_url'];
                $login_data['is_user_login'] = TRUE;


                $this->session->set_userdata($login_data);
            }else{
               $data['userData'] = array();
            }
            

        }else{
        	redirect( $this->facebook->login_url(), "refresh" );
        }
        
        // Load login & profile view
        // redirected to last request page
        if(!empty($this->session->userdata('last_request_page')))
        {
        	$back_to = $this->session->userdata('last_request_page');
        	redirect($back_to);
        }
        else
        {
        	redirect(base_url('profile'),'refresh');
        }
    }


    //---------------------------------------------------------------------------
    // Google Login

    public function googleLogin(){
            // Redirect to profile page if the user already logged in
            if($this->session->userdata('is_user_login') == true){
                redirect(base_url('profile'),'refresh');
            }
            
            if(isset($_GET['code'])){

                // Authenticate user with google
                if($this->google->isLoggedIn($_GET['code'])){
                
                    // Get user info from google
                    $gpInfo = $this->google->getUserInfo();
                    
                    // Preparing data for database insertion
                    $userData['oauth_provider'] = 'google';
                    $userData['oauth_uid']      = $gpInfo['id'];
                    $userData['firstname']     	= $gpInfo['given_name'];
                    $userData['lastname']      	= $gpInfo['family_name'];
                    $userData['email']          = $gpInfo['email'];
                    $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                    // $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                    // $userData['link']           = !empty($gpInfo['link'])?$gpInfo['link']:'';
                    $userData['profile_pic_url']        = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
                    
                    // Insert or update user data to the database
                    $userID = $this->auth_model->checkUser($userData);
                    
                    // Store the status and user profile info into session
                    // Check user data insert or update status
                    if(!empty($userID)){
                        $data['userData'] = $userData;
                        $login_data = $userData;
                        $login_data['user_id'] = $userID;
                		$login_data['username'] = $userData['firstname'];
                		$login_data['pro_pic'] = $userData['profile_pic_url'];
                        $login_data['is_user_login'] = TRUE;


                        $this->session->set_userdata($login_data);
                    }else{
                       $data['userData'] = array();
                    }
                    
                }
                 
            }else{
            	redirect( $this->google->getLoginUrl(), "refresh" );
        	}
            
            // Google authentication url
            // redirected to last request page
            if(!empty($this->session->userdata('last_request_page')))
            {
            	$back_to = $this->session->userdata('last_request_page');
            	redirect($back_to);
            }
            else
            {
            	redirect(base_url('profile'),'refresh');
            }
               
        }








}// endClass
