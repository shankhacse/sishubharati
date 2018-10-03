<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feesinfo extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('admissionmodel','admmodel',TRUE);
		$this->load->model('classmastermodel','classmastermodel',TRUE);
		$this->load->model('feesinfomodel','feesinfomodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['FeesInfoData']=[];
			$result['monthlyTutionData']=[];
			$result['classList'] = $this->classmastermodel->getAllClass(); 
			$where_fees_master = array('fees_master.session_id' =>$session['yid'] );
			
			$FessMasterData=$this->commondatamodel->getSingleRowByWhereCls('fees_master',$where_fees_master);

			if($FessMasterData){
			$feesmasterID=$FessMasterData->fees_master_id;

			$whereAry = array(
					'fees_details.fees_master_id' => $feesmasterID
				);
			$result['FeesInfoData'] = $this->commondatamodel->getAllRecordWhere('fees_details',$whereAry);

			$result['monthlyTutionData']=$this->feesinfomodel->getMonthlyTutionFees($feesmasterID,$session['yid']);

		}
			$page = "dashboard/adminpanel_dashboard/ds-fees/fees_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function addfeesinfo()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$classID = 0;
				$result['FeesInfoEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$classID = $this->uri->segment(3);
				$whereAry = array(
					'class_master.id' => $classID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['FeesInfoEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('class_master',$whereAry); 
				
			}

			$header = "";
			$clswhere = [
				"fees_type.is_active" => 1 
				];
			$result['feetypeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('fees_type',$clswhere,'fees_type.id'); 
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			$page = "dashboard/adminpanel_dashboard/ds-fees/fees_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



public function saveFees()
	{
		if($this->session->userdata('user_data'))
		{  
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			
			$session = $this->session->userdata('user_data');
			$feesID = $dataArry['feesID'];
			$admissionfee = $dataArry['admissionfee'];
			
			$feestype = $dataArry['feestype'];
			$feesamount = $dataArry['amount'];
			
			$feesradio = $dataArry['feesradio'];

			$classid = $dataArry['classid'];
			$monthlytution = $dataArry['monthlytution'];
			
			
			$mode = $dataArry['mode'];
			$where_fees_master = array('fees_master.session_id' =>$session['yid'] );
			
			$checkFessMaster=$this->commondatamodel->checkExistanceData('fees_master',$where_fees_master);
			if ($checkFessMaster) {
				$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : Fees Information Already Added."
					);
			}else{

			if($feesID>0 && $mode=="EDIT")
			{
				
				
				$update=1;
				if($update)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Updated successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}		
			}
			else
			{

				$fees_master_array = array(
				"session_id" => $session['yid'],
				"created_by" => $session['userid']
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('fees_master',$fees_master_array);
			$admissionfee_array = array(
				'fees_master_id' => $insert_id ,
				'fees_type' => 'Admission',
				'amount' => $admissionfee,
				'session_id' => $session['yid'],
				'fee_group_type' => 'ADFEE',
				 );

   $admissionFeeData=$this->commondatamodel->insertSingleTableData('fees_details',$admissionfee_array);

				for ($i=0; $i <count($feesamount) ; $i++) { 
					
				
				$fees_details_array = array(
				'fees_master_id' => $insert_id ,
				'fees_type' => $feestype[$i],
				'amount' => $feesamount[$i],
				'session_id' => $session['yid'],
				'fee_group_type' => 'SSFEE',
				 );

$insertData=$this->commondatamodel->insertSingleTableData('fees_details',$fees_details_array);

			 
				}

				for ($i=0; $i <count($monthlytution) ; $i++) { 

				$monthly_tution_fees = array(
							'fees_master_id' => $insert_id ,
							'class_id' => $classid[$i],
							'amount' => $monthlytution[$i],
							'session_id' => $session['yid'],
							'created_by' => $session['userid']
							 );
					
				

$insertTutionData=$this->commondatamodel->insertSingleTableData('monthly_tution_fees',$monthly_tution_fees);
	 
				}


				if($insertData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Saved successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}				
					
				
				    
			}


		}//else of check fees_master data
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('login','refresh');
		}
	}


}// end of class