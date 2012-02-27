<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * SRA - events Model Class
 *
 * Functions for handling events
 *
 * @package	Package Name
 * @subpackage	Subpackage
 * @category	Category
 * @author	Shawn Plummer
 * @link	http://example.com
 */

class events extends CI_Model 
{

	private $event_table_name				= 'event';			// events
	private $event_timeslot_name	= 'event_timeslot';	// look up table of events to timeslots

	function __construct()
	{
		parent::__construct();
	
		$ci =& get_instance();
		$this->event_table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->event_table_name;
		$this->event_timeslot_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->event_timeslot_name;
	}

	/**
	 * Get Event Info - Get the event information for the array values we are passed.
	 * 
	 * @param	array
	 * @return	array
	 * 
	 */
	function get_event($data)
	{
		$this->db->where($data);
		$query = $this->db->get($this->event_table_name);
				
		if ($query->num_rows() == 1) return $query->row_array();
		return NULL;
	}

	/**
	 * Create Evene - Creates a new event
	 * 
	 * @param 	array
	 * @return	int
	 * 
	 */
	function create_event($data)
	{
		$data['created'] = date('Y-m-d H:i:s');

		// First we need to create a resource in the ACL table for this event.
		// Make an array of resource info
		$event_resource = array(
			'name' 			=> $data['name'], 
			'description'	=> $data['description'],
		);
		// parentID could be blank if we inserting nothing is fine, inserting a non existent parentid will break things. 
		if (isset($data['org_id_resource_id'])) {
			$event_resource['parentid'] = $data['org_id_resource_id'] ;
		}

		$data['fk_acl_resources_id'] = $this->acl_model->add_resource($event_resource);

		if (!isset($data['fk_acl_resources_id']) OR $data['fk_acl_resources_id'] == '0') {
			return NULL;
		}

		if ($this->db->insert($this->event_table_name, $data)) {
			$event_id = $this->db->insert_id();
			return array('event_id' => $event_id);
		}
		return NULL;
	}

	/**
	 * Update Event Info
	 * 
	 * @param	string
	 * @param	array
	 * @return	bool
	 * 
	 */
	function update_event($event_id, $data)
	{
		$this->db->where('event_id', $event_id);
		$this->db->update($this->event_table_name, $data);

		return $this->db->affected_rows() > 0;
	}


}

/* End of file events.php */
/* Location: ./application/models/events.php */