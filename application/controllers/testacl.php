<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testacl extends CI_Controller
{
	function  __construct()
	{
		parent::__construct();
		$this->load->library('acl');
		define('ROLE', '6');
		define('RESOURCE', '1');
 	}

 function index() {
 echo '<pre>' ;
 print_r($this->acl);
 echo '</pre>';
  if (!$this->acl->can_read(ROLE, RESOURCE)) {
   die("You do not have permissions to read this resource");
  }
  echo "You have permission to read this resource!";
 }
 function write() {
  if (!$this->acl->can_write(ROLE, RESOURCE)) {
   die("You do not have permissions to write to this resource");
  }
  echo "You have permission to write to this resource!";
 }
 function modify() {
  if (!$this->acl->can_modify(ROLE, RESOURCE)) {
   die("You do not have permissions to modify this resource");
  }
  echo "You have permission to modify this resource!";
 }
 function delete() {
  if (!$this->acl->can_delete(ROLE, RESOURCE)) {
   die("You do not have permissions to delete this resource");
  }
  echo "You have permission to delete this resource!";
 }
 function publish() {
  if (!$this->acl->can_publish(ROLE, RESOURCE)) {
   die("You do not have permissions to publish this resource");
  }
  echo "You have permission to publish this resource!";
 }
}