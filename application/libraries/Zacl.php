<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once BASEPATH.'libraries/Zend/Acl.php';

class Zacl extends Zend_Acl 
{

	function __construct() 
	{
		$this->ci =& get_instance();
		
		$this->ci->load->model('acl_model');
		$this->acl = new Zend_Acl();
 		
 		// The following section accounts for PG's different sort order from MYSQL
 		// If I can figure out how to pass ASC NULLS FIRST to PG with CI then I can avoid this.
 		// If we were to load NULL parentid entries last then inheritance falls apart.
 		$this->ci->db->where('parentid IS NULL', null, false); //hack for PG sorting NULLS last
		$query = $this->ci->db->get('acl_roles');
		$roles = $query->result();
		foreach ($roles as $roles) { //Add the roles to the ACL
			$role = new Zend_Acl_Role($roles->id); 
			$this->acl->addRole($role);
		}

 		// The following section accounts for PG's different sort order from MYSQL
 		// If I can figure out how to pass ASC NULLS FIRST to PG with CI then I can avoid this.
 		// If we were to load NULL parentid entries last then inheritance falls apart.
 		$this->ci->db->where('parentid IS NULL', null, false); //hack for PG sorting NULLS last
		$query = $this->ci->db->get('acl_resources');
		$resources = $query->result();
		foreach ($resources as $resources) { //Add the roles to the ACL
			$resource = new Zend_Acl_Resource($resources->id); 
			$this->acl->add($resource);
		}


 		$this->ci->db->where('parentid IS NOT NULL', null, false); // We already added NULLS above
		$this->ci->db->order_by('parentid', 'ASC'); //Get the roles
		$query = $this->ci->db->get('acl_roles');
		$roles = $query->result();

 		$this->ci->db->where('parentid IS NOT NULL', null, false); // We already added NULLS above
		$this->ci->db->order_by('parentid', 'ASC'); //Get the resources
		$query = $this->ci->db->get('acl_resources');
		$resources = $query->result();

		$query = $this->ci->db->get('acl_permissions'); //Get the permissions
		$permissions = $query->result();

		foreach ($roles as $roles) { //Add the roles to the ACL
			$role = new Zend_Acl_Role($roles->id);
			$roles->parentid != NULL ?
				$this->acl->addRole($role,$roles->parentid): 
				$this->acl->addRole($role);
		}
 
		foreach($resources as $resources) { //Add the resources to the ACL
			$resource = new Zend_Acl_Resource($resources->id);
			$resources->parentid != NULL ?
				$this->acl->add($resource, $resources->parentid):
				$this->acl->add($resource);
		}
 
		foreach($permissions as $perms) { //Add the permissions to the ACL
			$perms->read == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'read') : 
				$this->acl->deny($perms->role, $perms->resource, 'read');
			$perms->create == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'create') : 
				$this->acl->deny($perms->role, $perms->resource, 'create');
			$perms->modify == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'modify') : 
				$this->acl->deny($perms->role, $perms->resource, 'modify');
			$perms->publish == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'publish') : 
				$this->acl->deny($perms->role, $perms->resource, 'publish');
			$perms->delete == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'delete') : 
				$this->acl->deny($perms->role, $perms->resource, 'delete');
		}
		$this->acl->allow('1'); //Change this to whatever id your adminstrators group is
	}

	/**
	 * check_acl - check's the acl for a given resource and action, role is optional
	 * will check all roles of a given user and return true if any of them are true.
	 * 
	 * @param	- int
	 * @param	- string
	 * @param	- object
	 * @return	- boolean
	 * 
	 */
	function check_acl($resource, $action, $roles = '')
	{
		// if the resource is not found in the ACL then return 1
		if (!$this->acl->has($resource))
        {
			return 1;
        }
    	// if we were not passed a role lookup the current user's role(s)
        if (empty($roles)) {
        	if (isset($this->ci->session->userdata['user_id'])) {
				$roles = $this->ci->acl_model->get_user_roles($this->ci->session->userdata['user_id']);
			}
		}
		// If we can still not find any roles then return FALSE they are likely not logged in.
		if (empty($roles)) {
			return FALSE;
		}
		// do an isAllowed for each role of a user until one returns true. 
		// If none do then return false.
		foreach ($roles as $roles)
		{
        	if ($this->acl->isAllowed($roles->fk_acl_roles_id, $resource, $action))
        	{
				return TRUE;
			}
		}
		return FALSE;
	}

	/*
	 * Methods to query the ACL. These need work I think, for one they do not check all
	 * all of a user's roles.
	 */
 
	function can_read($resource, $role) {
		return $this->acl->isAllowed($role, $resource, 'read')? TRUE : FALSE;
	}
	function can_write($resource, $role) {
		return $this->acl->isAllowed($role, $resource, 'create')? TRUE : FALSE;
	}
	function can_modify($resource, $role) {
		return $this->acl->isAllowed($role, $resource, 'modify')? TRUE : FALSE;
	}
	function can_delete($resource, $role) {
		return $this->acl->isAllowed($role, $resource, 'delete')? TRUE : FALSE;
	}
    function can_publish($resource, $role) {
		return $this->acl->isAllowed($role, $resource, 'publish')? TRUE : FALSE;
	}
}