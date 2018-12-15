<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdftest extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	 
		
	}
		
	public function index()
	{ 
		// load library
        $this->load->library('pdfl');
       // $pdf = new pdfl();
                
        $pdf = $this->pdfl->load();
		$page = 'dashboard/adminpanel_dashboard/ds-pdf/pdf';
		$result['data']="Hello";
		echo $this->load->view($page,$result,true);
		
    

                 ini_set('memory_limit', '256M'); 
                 
                $html = $this->load->view($page, $result, true);
                // render the view into HTML
                
                $pdf->WriteHTML($html); 
                $output = 'saleBillPdf' . date('Y_m_d_H_i_s') . '_.pdf'; 
                $pdf->Output("$output", 'I');
                $pdf->Output();
                exit(); 
		
	}

}//end of class