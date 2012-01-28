<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * SRA - user_profile_model Model Class
 *
 * Functions for messing with user profiles
 *
 * @package	Package Name
 * @subpackage	Subpackage
 * @category	Category
 * @author	Shawn Plummer
 * @link	http://example.com
 */

class User_profile_model extends CI_Model 
{

	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();
	
		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
	}

	/**
	 * Get user Profile - Get the user profile information for the currently logged in user.
	 * 
	 * @param	int
	 * @return	object
	 * 
	 */
	function get_user_profile($user_id)
	{
		$this->db->where('user_id', $user_id);
		$query = $this->db->get($this->profile_table_name);
				
		if ($query->num_rows() == 1) return $query->row_array();
		return NULL;
	}


	/**
	 * Update User Profile
	 * 
	 * @param	string
	 * @param	array
	 * @return	bool
	 * 
	 */
	function update_user_profile($user_id, $profile_info)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update($this->profile_table_name, $profile_info);

		return $this->db->affected_rows() > 0;
	}
}

/* End of file user_profile_model.php */
/* Location: ./application/models/user_profile_model.php */