<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentomodel extends CI_Model{
	public function __construct()
	{
		$this->load->model('admissionmodel','admissionmodel',TRUE);
	
	}
	
	public function getUnpaidAdmissionFees($session_id){
		$data = [];
		$where = array(
					'student_master.adm_fee_payment' =>'N',
					'student_academic_details.session_id' =>$session_id,
					'student_academic_details.aca_fee_payment' =>'N',
					'student_academic_details.is_active' =>'N'
					 );

		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									student_academic_details.academic_id
								")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}


	public function getUnpaidAdmissionFeesByClass($session_id,$class_id){
		$data = [];
		$where = array(
					'student_master.adm_fee_payment' =>'N',
					'student_academic_details.session_id' =>$session_id,
					'student_academic_details.aca_fee_payment' =>'N',
					'student_academic_details.is_active' =>'N',
					'student_academic_details.class_id' =>$class_id
					 );

		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									student_academic_details.academic_id
								")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}

public function getUnpaidSessionFees($session_id){
		$data = [];
		$where = array(
					'student_master.adm_fee_payment' =>'Y',
					'student_academic_details.session_id' =>$session_id,
					'student_academic_details.aca_fee_payment' =>'N',
					'student_academic_details.is_active' =>'N'
					 );

		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									student_academic_details.academic_id
								")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}


public function getUnpaidSessionFeesByClass($session_id,$class_id){
		$data = [];
		$where = array(
					'student_master.adm_fee_payment' =>'Y',
					'student_academic_details.session_id' =>$session_id,
					'student_academic_details.aca_fee_payment' =>'N',
					'student_academic_details.is_active' =>'N',
					'student_academic_details.class_id' =>$class_id
					 );

		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									student_academic_details.academic_id
								")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}


	/* get admissionfees details*/

		public function getAdmissionFeesDetails($session_id){
		$data = [];
	
		$where = array('fees_details.session_id' =>$session_id);

		$query = $this->db->select("*")
				->from('fees_details')	
				->where($where)
				->order_by('fees_details.fees_details_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}



	/* get sessionfees details*/

		public function getSessionFeesDetails($session_id){
		$data = [];
	
		$where = array(
						'fees_details.session_id' =>$session_id,
						'fees_details.fee_group_type' =>'SSFEE'
					  );

		$query = $this->db->select("*")
				->from('fees_details')	
				->where($where)
				->order_by('fees_details.fees_details_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}

/*get student list for payment tution fee*/

public function getStudentListForTutionByClass($session_id,$class_id){
		$data = [];
		$where = array(
							'student_academic_details.session_id' => $session_id, 
							'student_academic_details.class_id' => $class_id, 
							'student_academic_details.is_active' => 'Y' 
						  );

		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									student_academic_details.academic_id
								")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_roll')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}

	/* get student ID list for payment history*/

		public function getStudentIdList($session_id){
		$data = [];
	
		$where = array(
						'student_academic_details.session_id' =>$session_id,
						'student_academic_details.is_active' =>'Y' 
					);

		$query = $this->db->select("*")
				->from('student_academic_details')	
				->where($where)
				->order_by('student_academic_details.student_uniq_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}
/* Get  student Id list by class for payment history*/

public function getStudentsIdbyClass($session_id,$sel_class)
	{
	
		$data = array();
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y' 
					  );
		
			$query = $this->db->select("
										student_academic_details.*,
										student_master.name as student_name
										")
					->from('student_academic_details')
					
					->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
					
					->where($where)
					->get();

		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


		/* get payment list by academic id*/

		public function getPaymentList($academic_id){
		$data = [];
	
		$where = array(
						'payment_master.academic_id' =>$academic_id
					);

		$query = $this->db->select("payment_master.*,
									class_master.name as class_name,
									student_master.name as student_name,
									bill_master.bill_no
									")
				->from('payment_master')
				->join('student_academic_details','student_academic_details.academic_id = payment_master.academic_id','INNER')	
				->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->join('bill_master','bill_master.bill_master_id = payment_master.bill_master_id','INNER')
				->where($where)
				->order_by('payment_master.payment_dt','DESC')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}

	/* get bill details data*/

		public function getBillDetailsData($bill_master_id){
		$data = [];
	
		$where = array(
						'bill_details.bill_master_id' =>$bill_master_id
						
					  );

		$query = $this->db->select("bill_details.*,
									bill_master.bill_no")
				->from('bill_details')
				->join('bill_master','bill_master.bill_master_id = bill_details.bill_master_id','INNER')	
				->where($where)
				->order_by('bill_details.bill_details_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}





	/* get paid unpaid student list working on 01.10.2018*/

		public function getPaidUnpaidTutionFeeByClass($session_id,$sel_class,$sel_month){
		$data = [];
	
		$where = array(
						'student_academic_details.session_id' =>$session_id,
						'student_academic_details.class_id' =>$sel_class
					   );

		$query = $this->db->select("student_academic_details.*,
								    class_master.name as class_name,
									student_master.name as student_name
									")
				->from('student_academic_details')	
				->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->order_by('student_academic_details.class_roll')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                foreach($query->result() as $rows)
				{
					//$data[] = $rows;
					$data[] = array(
					"studentMasterData" => $rows,
					"paidUnpaid"=>$this->checkPaidUnpaid($sel_month,$rows->academic_id,$session_id)
						);
				}
	             
                        }
			
	        return $data;
	       
	}

/* check paid unpaid*/

	public function checkPaidUnpaid($month,$academic_id,$session_id)
	{
		$data = array();
		$where = array(
						'payment_master.academic_id' =>$academic_id,
						'payment_master.for_month' =>$month,
						'payment_master.session_id' =>$session_id,
						
						 );

		$this->db->select("*")
				->from('payment_master')
				->where($where);

		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();

		if($query->num_rows()> 0)
		{
            
            return 'Paid';
             
        }
		else
		{
             return 'Unpaid';
         }
	}
}//end of class