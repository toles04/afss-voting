<?php 
/**
* MY_Controller
*/
class MY_Controller extends MX_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->module('Template');
	}
}