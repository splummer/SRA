<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * SRA - Event Controller
 *
 *
 */

class Event extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'array'));
		$this->load->library('form_validation');
		$this->load->model('events');
		$this->load->model('acl_model');
		
		// if they are not logged in, direct them to login
		if ( ! $this->tank_auth->is_logged_in()) redirect('/auth/login/');

	}

	/**
	 * Create event - Presents the event form to create a new event
	 * 
	 * @param	 int
	 * 
	 */
	function create()
	{
		$this->form_validation->set_rules('name', 'Event Name', 'trim|required|max_length[40]');
		$this->form_validation->set_rules('short_name', 'Event Short Name', 'trim|required|max_length[12]');
		$this->form_validation->set_rules('description', 'Event Name', 'trim|required|max_length[255]');


		if( ! $this->form_validation->run())
		{
	
			$data['main_view'] = 'event/event_form';
			$data['title'] = 'Create Event';
			$this->load->view('includes/template', $data);
		}
		else
		{
			$data['event_info'] = array (
				'name' 			=> $this->input->post('name'),
				'short_name' 	=> url_title($this->input->post('short_name'), 'underscore'),
				'description' 	=> $this->input->post('description'),
				'start_time' 	=> $this->input->post('start_date') . ' ' . $this->input->post('start_time') . ' EDT',
				'end_time'		=> $this->input->post('end_date') . ' ' . $this->input->post('end_time') . ' EDT',
			);

			$this->events->create_event($data['event_info']);

			echo '<pre>';
			print_r ($data);
			echo '</pre>';
			//redirect('event/event_id');
		}
	}
	}

/* End of file event.php */
/* Location: ./application/controllers/event.php */