<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    This file is part of Publish Notes add-on for ExpressionEngine.

    Publish Notes is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Publish Notes is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    Read the terms of the GNU General Public License
    at <http://www.gnu.org/licenses/>.

    Copyright 2016 Derek Hogue
*/

include(PATH_THIRD.'/publish_notes/config.php');

class Publish_notes_ft extends EE_Fieldtype {

	public $default_settings = [
        'show_heading' => '',
		'display_style' => 'plain',
		'formatting' => 'xhtml',
         'field_hide_title' => true,
        'field_hide_publish_layout_collapse' => true,
    ];
	
	var $info = array(
		'name'		=> 'Publish Notes',
		'version'	=> PUBLISH_NOTES_VERSION
	);
	
	function __construct()
	{
		ee()->lang->loadfile('publish_notes');
	}


	function accepts_content_type($name)
	{
		return ($name == 'channel');
	}
	

	function display_settings($data)
	{	
		ee()->load->model('addons_model');
		$format_options = ee()->addons_model->get_plugin_formatting(TRUE);
		$display_styles = array(
			'plain' => lang('plain'),
			'attention' => lang('attention'),
			'important' => lang('important'),
			'success' => lang('success')
		);
		
		$settings = array(
			'publish_notes' => array(
				'label' => $this->info['name'],
				'group' => 'publish_notes',
				'settings' => array(
					array(
						'title' => 'show_heading',
						'desc' => lang('show_heading_desc'),
						'fields' => array(
							'show_heading' => array(
								'type' => 'yes_no',
								'value' => (isset($data['show_heading'])) ? $data['show_heading'] : 'n'
							)
						)
					),
					array(
						'title' => 'display_style',
						'desc' => lang('display_style_desc'),
						'fields' => array(
							'display_style' => array(
								'type' => 'select',
								'choices' => $display_styles,
								'value' => (isset($data['display_style'])) ? $data['display_style'] : 'warn'
							)
						)
					),
					array(
						'title' => 'formatting',
						'desc' => lang('formatting_desc'),
						'fields' => array(
							'formatting' => array(
								'type' => 'select',
								'choices' => $format_options,
								'value' => isset($data['formatting']) ? $data['formatting'] : 'xhtml',
							)
						)
					)
				)
			)
		);
		return $settings;
	}
	

	function save_settings($data)
	{
		$all = array_merge($this->default_settings, $data);
        return array_intersect_key($all, $this->default_settings);
	}


	function save($data)
	{
		return null;
	}


	function display_field($data)
	{
		if(!defined('PUBLISH_NOTES_ASSETS_LOADED'))
		{
			ee()->cp->load_package_css('publish');
			define('PUBLISH_NOTES_ASSETS_LOADED', 'y');
		}
		
		ee()->load->library('typography');
		ee()->typography->initialize();
		
		$notes = ee()->typography->parse_type(
			$this->settings['field_instructions'],
			array(
				'text_format' => $this->settings['formatting'],
				'html_format' => 'all',
				'auto_links' => 'n',
				'allow_img_url' => 'y'
			)
		);
		
		$r = '<div class="publish-notes-field app-notice app-notice--inline app-notice---'.$this->settings['display_style'].'"><div class="app-notice__content">';
		if(!empty($this->settings['show_heading']) && $this->settings['show_heading'] == 'y')
		{
			$r .= '<p class="alert__title">'.$this->settings['field_label'].'</p>';
		}
		$r .= $notes;
		$r .= '</div></div>';
		
		return $r;
	}


	function replace_tag($data, $params = array(), $tagdata = FALSE)
	{
		return $data;
	}

	
	function update($current = '')
	{
		if($current == $this->info['version'])
		{
			return FALSE;
		}
		return TRUE;
	}	

}