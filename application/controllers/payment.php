<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('paymentomodel','paymentomodel',TRUE);
	   $this->load->model('admissionmodel','admissionmodel',TRUE);
		
	}
/* get all students list of unpaid admission fees*/		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment/unpaid_new_admission_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['unpaidStudentList']=$this->paymentomodel->getUnpaidAdmissionFees($session['yid']);
			//pre($result['unpaidStudentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

/* get all students list of unpaid admission fees by class*/
	public function getUnpaidAdmFeeListbyClass()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				
			$result['unpaidStudentList']=$this->paymentomodel->getUnpaidAdmissionFeesByClass($session['yid'],$sel_class);
           
			}else{
					

           $result['unpaidStudentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-payment/unpaid_new_admission_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}
/* get all students list of unpaid session fees*/
public function unpaidSessionFee()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment/unpaid_session_fee_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['unpaidStudentList']=$this->paymentomodel->getUnpaidSessionFees($session['yid']);
			//pre($result['unpaidStudentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

/* get all students list of unpaid session fees by class*/
	public function getUnpaidSesFeeListbyClass()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				
			$result['unpaidStudentList']=$this->paymentomodel->getUnpaidSessionFeesByClass($session['yid'],$sel_class);
           
			}else{
					

           $result['unpaidStudentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-payment/unpaid_session_fee_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* get payment details for paymeny fees */
	public function getDetailsForPayment()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$student_id = trim(htmlspecialchars($this->input->post('studentid')));
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$info = trim(htmlspecialchars($this->input->post('studentname')));
			$academicid = trim(htmlspecialchars($this->input->post('academicid')));
			$classname = trim(htmlspecialchars($this->input->post('classname')));
			$classroll = trim(htmlspecialchars($this->input->post('classroll')));
			 $where_academic = array('student_academic_details.academic_id' => $academicid);
			$academicData=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where_academic);

			
			$class_id=$academicData->class_id;
			
			$data['studentname'] = $info;
			$data['studentID'] = $student_id;
			$data['classname'] = $classname;
			$data['classroll'] = $classroll;
			$data['academicid'] = $academicid;
			
			if($mode=="ADMFEE")
			{
				$page = "dashboard/adminpanel_dashboard/ds-payment/payment-modal/pay_admission_fee_partial_modal_view";
				
				
				$where = array(
								'fees_details.session_id' => $session['yid'] 
							  );
				$orderby='fees_details.fees_details_id';

				$data['admissionFeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('fees_details',$where,$orderby);		

				$PaymentDetailView = $this->load->view($page,$data);
			}elseif ($mode=="SESFEE") {
				$page = "dashboard/adminpanel_dashboard/ds-payment/payment-modal/pay_session_fee_partial_modal_view";
				
				
				$where = array(
								'fees_details.session_id' => $session['yid'], 
								'fees_details.fee_group_type' => 'SSFEE' 
							  );
				$orderby='fees_details.fees_details_id';

				$data['sessionFeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('fees_details',$where,$orderby);		

				$PaymentDetailView = $this->load->view($page,$data);
				
			}elseif ($mode=="MONFEE") {
				$page = "dashboard/adminpanel_dashboard/ds-payment/payment-modal/pay_tution_fee_partial_modal_view";
				
				
				$where = array(
								'monthly_tution_fees.session_id' => $session['yid'], 
								'monthly_tution_fees.class_id' => $class_id 
							  );
				$orderby='monthly_tution_fees.id';
				$data['monthList']=$this->commondatamodel->getAllDropdownData('months_master');
				$data['tutionFeeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('monthly_tution_fees',$where,$orderby);		

				$PaymentDetailView = $this->load->view($page,$data);
				
			}

			echo $PaymentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}

/* save admission fee details of a student*/
public function savepayAdmissionFee()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$academicid=$dataArry['academicid'];
			$payment_dt=$dataArry['payment_dt'];
			if($payment_dt!=""){
				$payment_dt = str_replace('/', '-', $payment_dt);
				$payment_dt = date("Y-m-d",strtotime($payment_dt));
			 }
			 else{
				 $payment_dt = NULL;
			 }

		   $where = array('student_academic_details.academic_id' => $academicid);
			$academicData=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$student_uniq_id=$academicData->student_uniq_id;
			$class_id=$academicData->class_id;
			$class_roll=$academicData->class_roll;
			$session_id=$academicData->session_id;


			$latest_serial = $this->admissionmodel->getLatestSerialNumber("ADB"); //it will change
			$billno = "ADB/".$latest_serial;

			$billmaster_data = array(
									 'bill_no' => $billno,
									 'payment_for' => 'Admission Fees',
									 'student_uniq_id' => $student_uniq_id,
									 'academic_id' => $academicid,
									 'session_id' => $session_id,
									 );

			/*Insert into billmaster*/
			$billmasterid=$this->commondatamodel->insertSingleTableDataRerurnInsertId('bill_master',$billmaster_data);


    /*Insert into billdetails*/

    $admissionFeeList=$this->paymentomodel->getAdmissionFeesDetails($session_id);
    $totalamount=0;
    foreach ($admissionFeeList as  $value) {
    	
    	$totalamount=$totalamount+$value->amount;

    	$bill_details_data = array(
    								'bill_master_id' => $billmasterid, 
    								'payment_desc' => $value->fees_type, 
    								'amount' => $value->amount, 
    								'session_id' => $session_id
    							   );
    
        $this->commondatamodel->insertSingleTableData('bill_details',$bill_details_data);


    }

    	$paymentmaster_data = array(
    								'payment_dt' => $payment_dt,
    								'payment_for' => 'ADM',
    								'student_uniq_id' => $student_uniq_id,
    								'academic_id' => $academicid,
    								'session_id' => $session_id,
    								'amount' => $totalamount,
    								'fine_amount' => 0,
    								'total_amt' => $totalamount,
    								'bill_master_id' => $billmasterid
    								
    							   );
    	


$payment_insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_master',$paymentmaster_data);


					if($payment_insert_id)
					{


						$stusent_mst_data = array(
												  'adm_fee_payment' => 'Y', 
												  'payment_master_id' => $payment_insert_id
												);
						$student_mst_where = array('student_uniq_id' =>$student_uniq_id);

						$this->commondatamodel->updateDataSingleTable('student_master',$stusent_mst_data,$student_mst_where);

						$academic_dtl_data = array('aca_fee_payment' => 'Y','is_active' => 'Y');
						$acade_dtl_where = array('academic_id' =>$academicid);
						
						$this->commondatamodel->updateDataSingleTable('student_academic_details',$academic_dtl_data,$acade_dtl_where);

						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "saved successfully"
							
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while saving ...Please try again."
						);
					}

					header('Content-Type: application/json');
					echo json_encode( $json_response );
					exit;


		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


/* save session fee details of a student working on 27.09.2018*/
public function savepaySessionFee()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$academicid=$dataArry['academicid'];
			$payment_dt=$dataArry['payment_dt'];
			if($payment_dt!=""){
				$payment_dt = str_replace('/', '-', $payment_dt);
				$payment_dt = date("Y-m-d",strtotime($payment_dt));
			 }
			 else{
				 $payment_dt = NULL;
			 }

		   $where = array('student_academic_details.academic_id' => $academicid);
			$academicData=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$student_uniq_id=$academicData->student_uniq_id;
			$class_id=$academicData->class_id;
			$class_roll=$academicData->class_roll;
			$session_id=$academicData->session_id;


			$latest_serial = $this->admissionmodel->getLatestSerialNumber("SEB"); //it will change
			$billno = "SEB/".$latest_serial;

			$billmaster_data = array(
									 'bill_no' => $billno,
									 'payment_for' => 'Session Fees',
									 'student_uniq_id' => $student_uniq_id,
									 'academic_id' => $academicid,
									 'session_id' => $session_id,
									 );

			/*Insert into billmaster*/
			$billmasterid=$this->commondatamodel->insertSingleTableDataRerurnInsertId('bill_master',$billmaster_data);


    /*Insert into billdetails*/

    $sessionFeeList=$this->paymentomodel->getSessionFeesDetails($session_id);
    $totalamount=0;
    foreach ($sessionFeeList as  $value) {
    	
    	$totalamount=$totalamount+$value->amount;

    	$bill_details_data = array(
    								'bill_master_id' => $billmasterid, 
    								'payment_desc' => $value->fees_type, 
    								'amount' => $value->amount, 
    								'session_id' => $session_id
    							   );
    
        $this->commondatamodel->insertSingleTableData('bill_details',$bill_details_data);


    }

    	$paymentmaster_data = array(
    								'payment_dt' => $payment_dt,
    								'payment_for' => 'SES',
    								'student_uniq_id' => $student_uniq_id,
    								'academic_id' => $academicid,
    								'session_id' => $session_id,
    								'amount' => $totalamount,
    								'fine_amount' => 0,
    								'total_amt' => $totalamount,
    								'bill_master_id' => $billmasterid
    								
    							   );
    	


$payment_insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_master',$paymentmaster_data);


					if($payment_insert_id)
					{


						$academic_dtl_data = array(
													'aca_fee_payment' => 'Y',
													'is_active' => 'Y',
													'payment_master_id' => $payment_insert_id
												);
						$acade_dtl_where = array('academic_id' =>$academicid);
						
						$this->commondatamodel->updateDataSingleTable('student_academic_details',$academic_dtl_data,$acade_dtl_where);

						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "saved successfully"
							
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while saving ...Please try again."
						);
					}

					header('Content-Type: application/json');
					echo json_encode( $json_response );
					exit;


		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


/* get all students list of unpaid admission fees*/		
	public function tutionfee()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment/pay_tution_fee_list_view.php';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['unpaidStudentList']=$this->paymentomodel->getUnpaidAdmissionFees($session['yid']);
			//pre($result['unpaidStudentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


/* get all students list for Tution Fee by class working 28.09.2018*/
	public function getStudentListForTutionFeebyClass()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				$result['StudentList'] = $this->paymentomodel->getStudentListForTutionByClass($session['yid'],$sel_class);
           
			}else{
					

           $result['StudentList']=[];
			}


			//pre($result['StudentList']);exit;
			$page = "dashboard/adminpanel_dashboard/ds-payment/pay_tution_fee_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



/* save Tution fee details of a student working on 28.09.2018*/
public function savepayTutionFee()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$academicid=$dataArry['academicid'];
			$payment_dt=$dataArry['payment_dt'];
			$sel_month=$dataArry['sel_month'];
			$monthly_fee=$dataArry['monthly_fee'];
			$fine_amt=$dataArry['fine_amt_tution'];
			$note=$dataArry['note'];

			if ($fine_amt=="") {
				$fine_amt=0;
			}
			if($payment_dt!=""){
				$payment_dt = str_replace('/', '-', $payment_dt);
				$payment_dt = date("Y-m-d",strtotime($payment_dt));
			 }
			 else{
				 $payment_dt = NULL;
			 }
			 $where_check_paid = array(
			 							'payment_master.academic_id' => $academicid,
			 							'payment_master.for_month' => $sel_month
			 						   );

			 $checkpaid=$this->commondatamodel->checkExistanceData('payment_master',$where_check_paid);
			if(!$checkpaid){ 
		   $where = array('student_academic_details.academic_id' => $academicid);
			$academicData=$this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$student_uniq_id=$academicData->student_uniq_id;
			$class_id=$academicData->class_id;
			$class_roll=$academicData->class_roll;
			$session_id=$academicData->session_id;


			$latest_serial = $this->admissionmodel->getLatestSerialNumber("MOB"); //it will change
			$billno = "MOB/".$latest_serial;

			$billmaster_data = array(
									 'bill_no' => $billno,
									 'payment_for' => 'Tution Fees',
									 'student_uniq_id' => $student_uniq_id,
									 'academic_id' => $academicid,
									 'session_id' => $session_id,
									 );

			/*Insert into billmaster*/
			$billmasterid=$this->commondatamodel->insertSingleTableDataRerurnInsertId('bill_master',$billmaster_data);


    /*Insert into billdetails*/

 

    	$bill_details_data = array(
    								'bill_master_id' => $billmasterid, 
    								'payment_desc' => 'Monthly Tutions', 
    								'amount' => $monthly_fee+$fine_amt, 
    								'session_id' => $session_id
    							   );
    
        $this->commondatamodel->insertSingleTableData('bill_details',$bill_details_data);


    

    	$paymentmaster_data = array(
    								'payment_dt' => $payment_dt,
    								'payment_for' => 'MON',
    								'student_uniq_id' => $student_uniq_id,
    								'academic_id' => $academicid,
    								'session_id' => $session_id,
    								'amount' => $monthly_fee,
    								'fine_amount' => $fine_amt,
    								'total_amt' => $monthly_fee+$fine_amt,
    								'for_month' => $sel_month,
    								'note' => $note,
    								'bill_master_id' => $billmasterid
    								
    							   );
    	


$payment_insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('payment_master',$paymentmaster_data);


					if($payment_insert_id)
					{

						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "saved successfully"
							
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while saving ...Please try again."
						);
					}



				}else{

					$json_response = array(
							"msg_status" => 0,
							"msg_data" => "Already Paid."
						);
				}




					header('Content-Type: application/json');
					echo json_encode( $json_response );
					exit;

		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

/* get payment history view*/		
	public function paymentHistory()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment/payment_history_list_view.php';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['StudentIdList']=$this->paymentomodel->getStudentIdList($session['yid']);
			//pre($result['StudentIdList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}



/* get student paymeny history working on 30.09.2018*/
	public function getStudentPaymentHistory()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$sel_type_searchby=$dataArry['sel_type_searchby'];
			if ($sel_type_searchby=='SID') {
				
				if (isset($dataArry['sel_student_id'])) {
							$academic_id=$dataArry['sel_student_id'];
							$result['paymentList'] = $this->paymentomodel->getPaymentList($academic_id);
			           
							}else{
									

				           $result['paymentList']=[];
							}

			}else{
				
					if (isset($dataArry['sel_student_name'])) {
							$academic_id=$dataArry['sel_student_name'];
							$result['paymentList'] = $this->paymentomodel->getPaymentList($academic_id);
			           
							}else{
									

				           $result['paymentList']=[];
							}
			}
			
			


			//pre($result['paymentList']);exit;
			$page = "dashboard/adminpanel_dashboard/ds-payment/payment_history_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* for payment history*/
	public function getStudentName()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
				$classid = $this->input->post('classid');

       $data['studentlist'] = $this->paymentomodel->getStudentsIdbyClass($session['yid'],$classid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/ds-payment/student_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


/* get bill details data*/		
	public function getBillDetailData()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$data = [];
			

			$page = 'dashboard/adminpanel_dashboard/ds-payment/payment-modal/bill_details_partial_modal_view.php';
			$paymentid = $this->input->post('paymentid');
			$paymentfor = $this->input->post('paymentfor');
			$data['billno'] = $this->input->post('billno');

			$where = array('payment_master.payment_master_id' => $paymentid);
			$paymentData=$this->commondatamodel->getSingleRowByWhereCls('payment_master',$where);

			$bill_master_id=$paymentData->bill_master_id;
			$data['student_uniq_id']=$paymentData->student_uniq_id;


			
			$data['billDetails']=$this->paymentomodel->getBillDetailsData($bill_master_id);
			$BillDetailView = $this->load->view($page,$data);
			

			echo $BillDetailView;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

/* get paid unpaid*/		
	public function paidunpaid()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-payment/paid_unpaid_tution_fee_list_view.php';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$result['monthList']=$this->commondatamodel->getAllDropdownData('months_master');
			//pre($result['unpaidStudentList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	/* get paid unpaid student list by class and month working 01.10.2018*/
	public function getPaidUnpaidTutionFee()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				$sel_month = $dataArry['sel_month'];
				$result['month']=$sel_month;
				$result['StudentList'] = $this->paymentomodel->getPaidUnpaidTutionFeeByClass($session['yid'],$sel_class,$sel_month);
           
			}else{
					

           $result['StudentList']=[];
			}


			//pre($result['StudentList']);exit;
			$page = "dashboard/adminpanel_dashboard/ds-payment/paid_unpaid_tution_fee_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

}// end of class