<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testacl extends CI_Controller
{
	function  __construct()
	{
		parent::__construct();
		$this->load->library('zacl');
		define('ROLE', '7');
		define('RESOURCE', '3');
 	}


	function index() {
//		if (!$this->zacl->can_read(RESOURCE, ROLE)) {
		if (!$this->zacl->check_acl('3', 'read', $this->acl_model->get_user_roles('4'))) {
			die("You do not have permissions to read this resource");
		}
			echo "You have permission to read this resource!";
	}
	function write() {
		if (!$this->zacl->can_write(RESOURCE, ROLE)) {
			die("You do not have permissions to write to this resource");
		}
			echo "You have permission to write to this resource!";
	}
	function modify() {
		if (!$this->zacl->can_modify(RESOURCE, ROLE)) {
			die("You do not have permissions to modify this resource");
		}
			echo "You have permission to modify this resource!";
	}
	function delete() {
		if (!$this->zacl->check_acl('3', 'delete', $this->acl_model->get_user_roles('4'))) {
//		if (!$this->zacl->can_delete(RESOURCE, ROLE)) {
			die("You do not have permissions to delete this resource");
		}
			echo "You have permission to delete this resource!";
	}
	function publish() {
		if (!$this->zacl->can_publish(RESOURCE, ROLE)) {
			die("You do not have permissions to publish this resource");
		}
			echo "You have permission to publish this resource!";
	}
	function noaction() {
		if (!$this->zacl->check_acl('3', $this->acl_model->get_user_roles('4') )) {
//		if (!$this->zacl->can_delete(RESOURCE, ROLE)) {
			die("You do not have permissions to delete this resource");
		}
			echo "You have permission to delete this resource!";
	}

	function test_insert_resource() {
		$data = array ( 'name' => 'Test Org', 'description' => 'test description') ;
		print_r($this->acl_model->add_resource($data));
	}
}