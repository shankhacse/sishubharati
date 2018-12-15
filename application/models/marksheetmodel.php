<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class marksheetmodel extends CI_Model{
	
			/* Get all student by class*/

public function getAllStudentsbyClassMarksheet($session_id,$sel_class)
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
										student_academic_details.class_roll,
										student_academic_details.academic_id
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
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


public function getTopper($rank_master_id)
	{
		#$where = array('rank_details.rank_master_id' =>$rank_master_id );
		$data = array();
		 $sql="select rank_details.academic_id,rank_details.studentname as topper,
               max(rank_details.`grand_total`) from rank_details
               where rank_details.rank_master_id='".$rank_master_id."' 
               limit 1";

		$query = $this->db->query($sql);
		
		#echo $this->db->last_query();
		
		if($query->num_rows()> 0)
		{
           $row = $query->row();
           return $data = $row;
             
        }
		else
		{
            return $data;
        }
	}

}//end of class