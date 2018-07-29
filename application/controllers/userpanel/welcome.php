<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class welcome extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	
	}
	
	
	public function index()
	{
		echo "Userpanel/Welcome Controller";
	}


	public function methodcall()
	{
		echo "Userpanel/Welcome Controller/Methods";
	}


}
?>