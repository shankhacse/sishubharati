<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sendsms extends CI_Controller {
 
    function index()
    {
	$this->load->library('setupfile');
	$this->setupfile->send("917003319369", "Hello there this is message");
    }
}