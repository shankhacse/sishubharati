<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class studentloginmodel extends CI_Model{
	
	public function verifyStudentLogin($studentid,$dob){
		$data = [];
		$where = array(
							'student_master.student_uniq_id' =>$studentid,
							'student_master.password' =>$dob,

						 );
		
		$query = $this->db->select("
									student_master.*,
									student_academic_details.academic_id,
									student_academic_details.class_id,
									student_academic_details.session_id
									")
				->from('student_master')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
				->where($where)
				->order_by('student_academic_details.academic_id','desc')
				->limit(1)
				->get();
				 #q();
			
				if($query->num_rows()> 0){
			            $row = $query->row();
			            $data =array(
			                "student_autoid"=>$row->student_id,
			                "studentID"=>$row->student_uniq_id,
			                "academicID"=>$row->academic_id,
			                "academic_session_id"=>$row->session_id
			            );

		         		 return $data;
		        }
		        else{
		                 return $data;
		        }
			
	       
	       
	}


}//end of class