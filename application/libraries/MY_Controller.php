<?php

class MY_Controller extends Controller
{
	protected $main = array();	

	function __construct()
	{
		parent::Controller();
	}

	protected function render($view_file = null, $template = 'layouts/main') 
	{
		if (isset($view_file)) $this->main['body'] = $this->load->view($view_file, $this->main, true);
		$this->load->view($template, $this->main);
	}
}
