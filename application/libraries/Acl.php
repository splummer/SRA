<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once BASEPATH.'libraries/Zend/Acl.php';

class Acl extends Zend_Acl 
{
	function __construct() 
	{
		$CI = &get_instance();
		$this->acl = new Zend_Acl();
 		
 		// The following section accounts for PG's different sort order from MYSQL
 		// If I can figure out how to pass ASC NULLS FIRST to PG with CI then I can avoid this.
 		$CI->db->where('parentid IS NULL', null, false); //hack for PG sorting NULLS last
		$query = $CI->db->get('acl_roles');
		$roles = $query->result();
		foreach ($roles as $roles) { //Add the roles to the ACL
			$role = new Zend_Acl_Role($roles->id); 
			$this->acl->addRole($role);
		}

 		// The following section accounts for PG's different sort order from MYSQL
 		// If I can figure out how to pass ASC NULLS FIRST to PG with CI then I can avoid this.
 		$CI->db->where('parentid IS NULL', null, false); //hack for PG sorting NULLS last
		$query = $CI->db->get('acl_resources');
		$resources = $query->result();
		foreach ($resources as $resources) { //Add the roles to the ACL
			$resource = new Zend_Acl_Resource($resources->id); 
			$this->acl->add($resource);
		}


 		$CI->db->where('parentid IS NOT NULL', null, false); // We already added NULLS above
		$CI->db->order_by('parentid', 'ASC'); //Get the roles
		$query = $CI->db->get('acl_roles');
		$roles = $query->result();

 		$CI->db->where('parentid IS NOT NULL', null, false); // We already added NULLS above
		$CI->db->order_by('parentid', 'ASC'); //Get the resources
		$query = $CI->db->get('acl_resources');
		$resources = $query->result();

		$query = $CI->db->get('acl_permissions'); //Get the permissions
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
			$perms->write == 't' ? 
				$this->acl->allow($perms->role, $perms->resource, 'write') : 
				$this->acl->deny($perms->role, $perms->resource, 'write');
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
	/*
	 * Methods to query the ACL.
	 */
 
	function can_read($role, $resource) {
		return $this->acl->isAllowed($role, $resource, 'read')? TRUE : FALSE;
	}
	function can_write($role, $resource) {
		return $this->acl->isAllowed($role, $resource, 'write')? TRUE : FALSE;
	}
	function can_modify($role, $resource) {
		return $this->acl->isAllowed($role, $resource, 'modify')? TRUE : FALSE;
	}
	function can_delete($role, $resource) {
		return $this->acl->isAllowed($role, $resource, 'delete')? TRUE : FALSE;
	}
    function can_publish($role, $resource) {
		return $this->acl->isAllowed($role, $resource, 'publish')? TRUE : FALSE;
	}
}