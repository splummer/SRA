<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * SRA - acl_model Model Class
 *
 * Functions for getting and setting acls
 *
 * @author	Shawn Plummer
 */

class Acl_model extends CI_Model 
{
	private $acl_permissions_table	= 'acl_permissions';	// Permissions
	private $acl_resources_table	= 'acl_resources';	// Resources
	private $acl_roles_table		= 'acl_roles';	// Roles
	private $user_role_lookup_table	= 'user_role_lookup';	// Ties user to role
	

	/**
	 * get_user_roles- get all of a given users roles, takes user_id and returns
	 * object of all the users roles
	 * 
	 * @param	- int
	 * @return	- object
	 * 
	 */
	function get_user_roles($user_id)
	{
		$this->db->where('fk_user_id', $user_id);
		$this->db->order_by('fk_acl_roles_id');
		$query = $this->db->get($this->user_role_lookup_table);
		if ($query->num_rows() >0) 
		{ 
			return $query->result();
		} 
		return NULL;
	}

	/**
	 * add_user_role - Insert the user_id and role_id to the user_role_lookup table
	 * 
	 * @param	 - int
	 * @param	 - int
	 * @return	 - object
	 * 
	 */
	function add_user_role($user_id, $role_id)
	{
		$this->db->set('fk_user_id', $user_id);
		$this->db->set('fk_acl_roles_id', $role_id);
		return $this->db->insert($this->user_role_lookup_table);
	}

	/**
	 * add_resource - Add a record to the resource table and return the new acl_resource_id
	 * 
	 * @param	 - array
	 * @return	 - int
	 * 
	 */
	function add_resource($data)
	{
		$this->db->insert($this->acl_resources_table, $data);
		$acl_resource_id = $this->db->insert_id();
		return $acl_resource_id;
	}


	/**
	 * delete_user_role - Delete the user_id and role_id to the user_role_lookup table
	 * 
	 * @param	 - int
	 * @param	 - int
	 * @return	 - object
	 * 
	 */
	function delete_user_role($user_id, $role_id)
	{
		$this->db->where('fk_user_id', $user_id);
		$this->db->where('fk_acl_roles_id', $role_id);
		return $this->db->delete($this->user_role_lookup_table);
	}

	/**
	 * delete_all_user_roles Name - Delete all roles for given user_id
	 * 
	 * @param	 - int
	 * @return	 - object
	 * 
	 */
	function delete_all_user_roles($user_id)
	{
		$this->db->where('fk_user_id', $user_id);
		return $this->db->delete($this->user_role_lookup_table);
	}



}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */