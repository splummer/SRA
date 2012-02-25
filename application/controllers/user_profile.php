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

		$this->load->helper(array('form', 'array'));
		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->load->model('user_profile_model');
		$this->load->model('tank_auth/users');

		// if they are not logged in, direct them to login
		if ( ! $this->tank_auth->is_logged_in()) redirect('/auth/login/');

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

		$data['main_view'] = 'profile/user_home';
		$data['title'] = 'User Profile For';
		$this->load->view('includes/template', $data);
	}
	
	function update($user_id = '')
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|max_length[25]');
		$this->form_validation->set_rules('address_1', 'Address Line 1', 'trim|max_length[40]');
		$this->form_validation->set_rules('address_2', 'Address Line 2', 'trim|max_length[40]');
		$this->form_validation->set_rules('city', 'City', 'trim|max_length[30]');
		$this->form_validation->set_rules('state', 'State', 'trim|max_length[2]');
		$this->form_validation->set_rules('zip', 'Zip Code', 'trim|numeric|exact_length[5]');
		$this->form_validation->set_rules('country', 'Country', 'trim|max_length[2]');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|max_length[12]');
		$this->form_validation->set_rules('twitter', 'Twitter Username', 'trim|max_length[20]');
		
				
		if( ! $this->form_validation->run())
		{
			$data['user_profile'] = $this->user_profile_model->get_user_profile($this->tank_auth->get_user_id());
	
			$data['main_view'] = 'profile/edit_profile';
			$data['title'] = 'Edit User Profile';
			$this->load->view('includes/template', $data);
		}
		else
		{
			$data['profile_info'] = array (
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'nickname' => $this->input->post('nickname'),
				'address_1' => $this->input->post('address_1'),
				'address_2' => $this->input->post('address_2'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'country' => $this->input->post('country'),
				'phone' => $this->input->post('phone'),
			);
			$this->user_profile_model->update_user_profile($this->tank_auth->get_user_id(), $data['profile_info']);
			redirect('user_profile');
		}
	}

}


/* End of file user_profile.php */
/* Location: ./application/controllers/user_profile.php */