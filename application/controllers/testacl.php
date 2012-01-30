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
		if (!$this->zacl->can_read(ROLE, RESOURCE)) {
			die("You do not have permissions to read this resource");
		}
			echo "You have permission to read this resource!";
			echo '<pre>';
			print_r($this->acl_model->get_user_roles('3'));
			echo '</pre>';
	}
	function write() {
		if (!$this->zacl->can_write(ROLE, RESOURCE)) {
			die("You do not have permissions to write to this resource");
		}
			echo "You have permission to write to this resource!";
	}
	function modify() {
		if (!$this->zacl->can_modify(ROLE, RESOURCE)) {
			die("You do not have permissions to modify this resource");
		}
			echo "You have permission to modify this resource!";
	}
	function delete() {
		if (!$this->zacl->can_delete(ROLE, RESOURCE)) {
			die("You do not have permissions to delete this resource");
		}
			echo "You have permission to delete this resource!";
	}
	function publish() {
		if (!$this->zacl->can_publish(ROLE, RESOURCE)) {
			die("You do not have permissions to publish this resource");
		}
			echo "You have permission to publish this resource!";
	}
}