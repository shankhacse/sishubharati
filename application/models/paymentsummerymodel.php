<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentsummerymodel extends CI_Model{
	
	public function getGradeList(){
		$data = [];
		
		$query = $this->db->select("*")
				->from('grade_master')
				->order_by('grade_master.id','desc')
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



	public function getPaymentList($fromdt,$todt){
		$data = [];
		
		$sql="select payment_master.*,bill_master.bill_no,class_master.name as classname,
  			  student_master.name as student_name 
			  from payment_master
			  inner join bill_master
              on bill_master.bill_master_id=payment_master.bill_master_id
              inner join student_academic_details
		      on student_academic_details.academic_id=payment_master.academic_id
		      inner join class_master
		      on class_master.id = student_academic_details.class_id
		      INNER JOIN student_master
		      on student_master.student_uniq_id = student_academic_details.student_uniq_id
			  where `payment_master`.`payment_dt` 
			  between '".$fromdt."' and '".$todt."' order by payment_master.payment_dt";
		
		$query = $this->db->query($sql);
		
		#echo $this->db->last_query();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}


		public function getPaymentListByPaymentType($fromdt,$todt,$paymentType){
		$data = [];
		
		$sql="select payment_master.*,bill_master.bill_no,class_master.name as classname,
  			  student_master.name as student_name 
			  from payment_master
			  inner join bill_master
              on bill_master.bill_master_id=payment_master.bill_master_id
              inner join student_academic_details
   			  on student_academic_details.academic_id=payment_master.academic_id
   			  inner join class_master
   			  on class_master.id = student_academic_details.class_id
   			  INNER JOIN student_master
  			  on student_master.student_uniq_id = student_academic_details.student_uniq_id
			  where `payment_master`.`payment_dt` 
			  between '".$fromdt."' and '".$todt."' and payment_master.payment_for='".$paymentType."'
			  order by payment_master.payment_dt";
		
		$query = $this->db->query($sql);
		
		#echo $this->db->last_query();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}


}//end of class