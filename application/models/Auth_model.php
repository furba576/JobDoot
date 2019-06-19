<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	// registraion
	public function insert_into_users($data)
	{
		$this->db->insert('xx_users',$data);
		return true;
	}

	// login function
	public function login($data)
	{
		$query = $this->db->get_where('xx_users', array('email' => $data['email']));
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
		    $validPassword = password_verify($data['password'], $result['password']);
		    if($validPassword){
		        return $result = $query->row_array();
		    }

		}
	}

	//--------------------------------------------------------------------
	public function email_verification($code)
	{
		$this->db->select('email, token, is_active');
		$this->db->from('xx_users');
		$this->db->where('token', $code);
		$query = $this->db->get();
		$result= $query->result_array();
		$match = count($result);
		if($match > 0){
			$this->db->where('token', $code);
			$this->db->update('xx_users', array('is_verify' => 1, 'token'=> ''));
			return true;
		}
		else{
			return false;
			}
	}

	//============ Check User Email ============
    function check_user_mail($email)
    {
    	$result = $this->db->get_where('xx_users', array('email' => $email));

    	if($result->num_rows() > 0){
    		$result = $result->row_array();
    		return $result;
    	}
    	else {
    		return false;
    	}
    }

    //============ Update Reset Code Function ===================
    public function update_reset_code($reset_code, $user_id)
    {
    	$data = array('password_reset_code' => $reset_code);
    	$this->db->where('id', $user_id);
    	$this->db->update('xx_users', $data);
    }

    //============ Activation code for Password Reset Function ===================
    public function check_password_reset_code($code)
    {

    	$result = $this->db->get_where('xx_users',  array('password_reset_code' => $code ));
    	if($result->num_rows() > 0){
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    //============ Reset Password ===================
    public function reset_password($id, $new_password){
	    $data = array(
			'password_reset_code' => '',
			'password' => $new_password
	    );
		$this->db->where('password_reset_code', $id);
		$this->db->update('xx_users', $data);
		return true;
    }


    // check user for social login

    public function checkUser($userData = array()){
       	if(!empty($userData)){
           	//check whether user data already exists in database with same oauth info
           	$this->db->select('id');
           	$this->db->from('xx_users');
           	$this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
           	$prevQuery = $this->db->get();
           	$prevCheck = $prevQuery->num_rows();

           	if($prevCheck > 0){
               	$prevResult = $prevQuery->row_array();

               	//update user data
               	$userData['updated_date'] = date("Y-m-d H:i:s");
               	$update = $this->db->update('xx_users', $userData, array('id' => $prevResult['id']));

               	//get user ID
               	$userID = $prevResult['id'];
           	}else{
               	//insert user data
           		$userData['created_date']  = date("Y-m-d H:i:s");
               	$userData['updated_date'] = date("Y-m-d H:i:s");
               	$insert = $this->db->insert("xx_users", $userData);

               	//get user ID
               	$userID = $this->db->insert_id();
          	}
       	}

       	//return user ID
       	return $userID?$userID:FALSE;
   	}


}

?>
