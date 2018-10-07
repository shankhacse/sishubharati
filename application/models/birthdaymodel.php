<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class birthdaymodel extends CI_Model{
	
	public function getTodayBirthdayList($session_id,$daymonth){
		$data = [];
		$where = array(
							'student_academic_details.session_id' => $session_id,
							'student_academic_details.is_active' => 'Y' 
						  );
		$query = $this->db->select("student_academic_details.*,
									student_master.name as student_name,
									student_master.gender,
									student_master.date_of_birth,
									class_master.name as class_name,
									

			         ")
				->from('student_academic_details')
				->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
				->join('class_master','class_master.id = student_academic_details.class_id','INNER')
				->where($where)
				->where("DATE_FORMAT(student_master.date_of_birth,'%m-%d') =",$daymonth)
				->order_by('class_master.id')
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



}//end of class