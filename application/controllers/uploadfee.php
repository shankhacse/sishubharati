<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class uploadfee extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('admissionmodel','admmodel',TRUE);
		$this->load->model('classmastermodel','classmastermodel',TRUE);
		$this->load->model('uploadfeemodel','uploadfeemodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['FeesInfoData']=[];
			$result['monthlyTutionData']=[];

			$result['term']=$term='first';

			
			$where_uploadfees_master = array(
											'upload_fee_master.session_id' =>$session['yid'],
											'upload_fee_master.term' =>$term,
											 );
			
			$FessMasterData=$this->commondatamodel->getSingleRowByWhereCls('upload_fee_master',$where_uploadfees_master);

			if($FessMasterData){
			$masterID=$FessMasterData->upload_fee_master_id;


			$result['uploadFeesData']=$this->uploadfeemodel->getUploadFees($masterID);

		}else{
			$result['uploadFeesData']=[];
		}
		//pre($result['uploadFeesData']);
			$page = "dashboard/adminpanel_dashboard/ds-fees/upload_fees_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function adduploadfees()
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

			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');

			$page = "dashboard/adminpanel_dashboard/ds-fees/upload_fees_add_edit_view";
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
			$uploadfeesID = $dataArry['uploadfeesID'];
			$sel_term = $dataArry['sel_term'];
			
			
			
			
			

			$classid = $dataArry['classid'];
			$uploadfee = $dataArry['uploadfee'];
			
			
			$mode = $dataArry['mode'];
			$where_uploadfees_master = array(
										'upload_fee_master.session_id' =>$session['yid'], 
										'upload_fee_master.term' =>$sel_term, 
									);
			
			$checkUploadFess=$this->commondatamodel->checkExistanceData('upload_fee_master',$where_uploadfees_master);
			if ($checkUploadFess) {
				$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : Fees Information Already Added."
					);
			}else{

			if($uploadfeesID>0 && $mode=="EDIT")
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
				"term" => $sel_term,
				"created_by" => $session['userid'],
				"role" => $session['role'],
				"upload_type" => 'EXAMPAPER',
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('upload_fee_master',$fees_master_array);

				for ($i=0; $i <count($uploadfee) ; $i++) { 

				$upload_fees = array(
							'upload_fee_master_id' => $insert_id ,
							'class_id' => $classid[$i],
							'amount' => $uploadfee[$i],
							'session_id' => $session['yid']
							);
					
				

$insertData=$this->commondatamodel->insertSingleTableData('upload_fee_details',$upload_fees);
	 
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





	/* for getUploadFeesByTerm view*/
	public function getUploadFeesByTerm()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
				 $result['term']=$sel_term = $this->input->post('sel_term');

				    
    	$where_uploadfees_master = array(
											'upload_fee_master.session_id' =>$session['yid'],
											'upload_fee_master.term' =>$sel_term,
											 );
			
			$FessMasterData=$this->commondatamodel->getSingleRowByWhereCls('upload_fee_master',$where_uploadfees_master);

			if($FessMasterData){
			$masterID=$FessMasterData->upload_fee_master_id;


			$result['uploadFeesData']=$this->uploadfeemodel->getUploadFees($masterID);

		}else{
			$result['uploadFeesData']=[];
		}
       
       $page = "dashboard/adminpanel_dashboard/ds-fees/upload_fees_list_partial_view";
       $viewTemp = $this->load->view($page,$result);
			echo $viewTemp;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function UpdateUploadFeeIndviduals()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			
			$uploadfeedtlid = $dataArry['uploadfeedtlid'];
			$amount = $dataArry['amount'];
			
			
		
		
		
				
				$where = array('upload_fee_details.id' => $uploadfeedtlid );
	
				$details_array = array(
				'amount' => $amount ,
				 
				 );


				$update=$this->commondatamodel->updateDataSingleTable('upload_fee_details',$details_array,$where);

			

		if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Update successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem.Try again"
						);
					}

		

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('admin','refresh');
		}
	}

}// end of class