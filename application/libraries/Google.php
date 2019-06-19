<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Login with Google for Codeigniter
 *
 * Library for Codeigniter to authenticate users through Google OAuth 2.0 and get user profile info
 *
 * @authors     Harsha G, Nick Humphries
 * @license     MIT
 * @link        https://github.com/angel-of-death/Codeigniter-Google-OAuth-Login
 */

class Google {
	public function __construct()
	{
		$this->ci =& get_instance();

        // include_once __DIR__ . '/../vendor/autoload.php';
        include_once APPPATH . 'third_party/vendor/autoload.php';

		$this->ci->load->config('google');

		$this->ci->load->library('session');

		$this->client = new Google_Client();

		$google_config = $this->ci->config->item('google');

        $this->client->setApplicationName( $google_config['application_name'] );

        $this->client->setClientId( $google_config['client_id'] );
        $this->client->setClientSecret( $google_config['client_secret'] );
        $this->client->setRedirectUri( $google_config['redirect_uri'] );
        $this->client->setDeveloperKey($this->ci->config->item('apiKey'));

        // $this->client->addScope('https://www.googleapis.com/auth/userinfo.profile');
        $this->client->setScopes(array(
			"https://www.googleapis.com/auth/plus.login",
			"https://www.googleapis.com/auth/userinfo.email",
			"https://www.googleapis.com/auth/userinfo.profile",
			"https://www.googleapis.com/auth/plus.me"
		));
        $this->client->setAccessType('offline');

		if($this->ci->session->userdata('refreshToken')!=null)
		{
			$this->loggedIn = true;

			if($this->client->isAccessTokenExpired())
			{
				$this->client->refreshToken($this->ci->session->userdata('refreshToken'));
        		
        		$accessToken = $this->client->getAccessToken();

        		$this->client->setAccessToken($accessToken);
			}
		}
		else
		{
			$accessToken = $this->client->getAccessToken();

			if($accessToken!=null)
			{
				$this->client->revokeToken($accessToken);
			}

			$this->loggedIn = false;
		}

	}

	public function isLoggedIn( $code )
	{
		// return $this->loggedIn;
		return $this->client->authenticate( $code );
	}

	public function getLoginUrl()
	{
		return $this->client->createAuthUrl();
	}

	public function setAccessToken()
	{
		$this->client->authenticate($_GET['code']);

		$accessToken = $this->client->getAccessToken();

		$this->client->setAccessToken($accessToken);

		if(isset($accessToken['refresh_token']))
		{
			$this->ci->session->set_userdata('refreshToken', $accessToken['refresh_token']);
		}
	}

	public function getUserInfo()
	{
		$service = new Google_Service_Oauth2($this->client);

		return $service->userinfo->get();
	}


	public function logout()
	{
		$this->ci->session->unset_userdata('refreshToken');

		$accessToken = $this->client->getAccessToken();

		if($accessToken!=null)
		{
			$this->client->revokeToken($accessToken);
		}
	}
}

?>