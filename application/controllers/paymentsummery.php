<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class paymentsummery extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentsummerymodel','paymentsummerymodel',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment_summery/payment_summery_list_view';
			$result = [];
			$header = "";
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



	public function paymentList()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			

			$result=[];


			
			if (isset($dataArry['fromdt']) && isset($dataArry['todt'])) {
					$fromdt=$dataArry['fromdt'];
					$todt=$dataArry['todt'];

					if($fromdt!=""){
					$fromdt = str_replace('/', '-', $fromdt);
					$fromdt = date("Y-m-d",strtotime($fromdt));
					 }
					 else{
						 $fromdt = NULL;
					 }

					 if($todt!=""){
					$todt = str_replace('/', '-', $todt);
					$todt = date("Y-m-d",strtotime($todt));
					 }
					 else{
						 $todt = NULL;
					 }
				
			$result['paymentList'] = $this->paymentsummerymodel->getPaymentList($fromdt,$todt); 	
           
			}else{
					

           $result['paymentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-payment_summery/payment_summery_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

}//end of class