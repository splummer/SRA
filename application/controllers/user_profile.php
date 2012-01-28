<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * SRA - User Profile Controller
 *
 * For all the things related to user not included in Tank Auth. This may get folded
 * into auth controller.
 *
 */

class User_profile extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('tank_auth');
		$this->load->model('user_profile_model');
		$this->load->model('tank_auth/users');

		// if they are not logged in, direct them to login
		if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');

		}

	/**
	 * Default function
	 *
	 * Description: This loads the User's Profile 
	 * 
	 * @param - userid
	 */
	function index($user_id = '')
	{
		// Display the profile information for the currently logged in user.
		$data['user_profile'] = $this->user_profile_model->get_user_profile($this->tank_auth->get_user_id());

		$data['main_view'] = 'profile/user_profile';
		$data['title'] = 'User Profile For';
		$this->load->view('includes/template', $data);
	}
	
	function update($user_id = '')
	{
		
	}

}


/* End of file user_profile.php */
/* Location: ./application/controllers/user_profile.php */