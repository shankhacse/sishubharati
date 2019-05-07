<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class generaterankmodel extends CI_Model{

		/* Get all student rank by class*/

public function getAllStudentsbyClassRank($session_id,$sel_class)
	{
	
		$data = array();
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y' 
					  );
		
			$query = $this->db->select("
										student_master.*,
										class_master.name as class_name,
										student_academic_details.academic_id,
										student_academic_details.class_roll,
										student_academic_details.first_term_total,
										student_academic_details.second_term_total,
										student_academic_details.third_term_total,
										student_academic_details.special_marks,
										student_academic_details.grand_total
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->where($where)
					->order_by('student_academic_details.grand_total','desc')
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


public function getAllStudentsbyRankmasterId($rank_master_id)
	{
	
		$data = array();
		$where = array(
						'rank_details.rank_master_id' => $rank_master_id 
					  );
		
			$query = $this->db->select("*")
					->from('rank_details')
					->where($where)
					->order_by('rank_details.rank')
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

}//end of class