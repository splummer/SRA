<?php if( ! defined('BASEPATH') ) exit('No direct script access allowed');
/**
 * Squirrel Registration Authority - MY_form_helper
 *
 * 
 *
 * @package     Squirrel Registration Authority
 * @author      Shawn Plummer
 */

/**
 * state dropdown - Creates a list of states to select using values from the config
 * 
 * @param 	- string
 * @param	- array
 * @param	- string
 * @param	- boolean
 * @return	- dropdown form element of countries
 * 
 * example - echo state_dropdown('state', set_value('state', $user_profile['state']), $state_params)
 */
function state_dropdown ( $name='state', $selection=NULL, $params=NULL )
{
	$CI =& get_instance();
	$CI->config->load('form');
	$states = $CI->config->item('state_list');
	return form_dropdown($name, $states, $selection, $params);
}

/**
 * country dropdown - Creates a list of countries to select using values from the config
 * Taken from http://codeigniter.com/wiki/helper_dropdown_country_code and
 * http://codeigniter.com/forums/viewthread/141730/P10
 * 
 * @param 	- string
 * @param	- array
 * @param	- string
 * @param	- boolean
 * @return	- dropdown form element of countries
 * 
 * example - echo country_dropdown('country', '', set_value('country', $user_profile['country']))
 */
function  country_dropdown ( $name="country", $top_countries=array(), $selection=NULL, $show_all=TRUE )
{
	$CI =& get_instance();
	$CI->config->load('form');
	$countries = $CI->config->item('country_list');
	
	if (empty($top_countries))
		$top_countries = $CI->config->item('top_countries');

	$html = "<select name='{$name}'>";
	$selected = NULL;
	if(in_array($selection,$top_countries))	 {
		$top_selection = $selection;
		$all_selection = NULL;
		}
	else  {
		$top_selection = NULL;
		$all_selection = $selection;
		}

	if(!empty($top_countries))	{
		foreach($top_countries as $value)  {
			if(array_key_exists($value, $countries))  {
				if($value === $top_selection)  {
					$selected = "SELECTED";
					}
				$html .= "<option value='{$value}' {$selected}>{$countries[$value]}</option>";
				$selected = NULL;
				}
			}
		$html .= "<option>----------</option>";
		}

	if($show_all)  {
		foreach($countries as $key => $country)	 {
			if($key === $all_selection)	 {
				$selected = "SELECTED";
				}
			$html .= "<option value='{$key}' {$selected}>{$country}</option>";
			$selected = NULL;
			}
		}

	$html .= "</select>";
	return $html;
}