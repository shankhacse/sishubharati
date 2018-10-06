<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdftest extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->library('pdf');//load PHPExcel library
		
	}
		
	public function index()
	{
		$mpdf = new mPDF();
		$page = 'dashboard/adminpanel_dashboard/ds-pdf/pdf';
		$result="Hello";
		$html = $this->load->view($page,$result,true);
		
        $mpdf->WriteHTML($html);
        $mpdf->Output(); 
		
	}

}//end of class