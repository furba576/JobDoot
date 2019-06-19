<?php
class Mailer 
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	//=============================================================
	function registration_email($username, $email_verification_link)
	{
    $login_link = base_url('auth/login');  

		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Welcome to Onjob!</p>
            <p>Active your account with the link above and start your Career :</p>  
            <p>'.$email_verification_link.'</p>

            <br>
            <br>

            <p>Regards, <br> 
               Onjob Team <br> 
            </p>
    ';
		return $tpl;		
	}

	//=============================================================
	function pwd_reset_link($username, $reset_link)
	{
		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Welcome to OnJob!</p>
            <p>We have received a request to reset your password. If you did not initiate this request, you can simply ignore this message and no action will be taken.</p> 
            <p>To reset your password, please click the link below:</p> 
            <p>'.$reset_link.'</p>

            <br>
            <br>

            <p>© 2019 Onjob - All rights reserved</p>
    ';
		return $tpl;		
	}

	

}
?>