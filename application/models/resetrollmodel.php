<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class resetrollmodel extends CI_Model{
	
public function getAllStudentsbyClass($session_id,$sel_class)
	{
	
		$data = array();
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y', 
						'student_academic_details.aca_fee_payment' =>'Y' 
					  );
		
			$query = $this->db->select("
										student_master.*,
										class_master.name as class_name,
										student_academic_details.class_roll,
										student_academic_details.aca_fee_payment,
										student_academic_details.rank,
										student_academic_details.academic_id
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->where($where)
					->order_by('student_academic_details.rank')
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


/* update class roll rank wise*/

public function updateRollbyRank($upd_data,$upd_where)
	{
		 try {
            $this->db->trans_begin();
			$this->db->where($upd_where);
            $this->db->update('student_academic_details',$upd_data);
            #echo $this->db->last_query();
			
				
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
		catch (Exception $err) {
            echo $err->getTraceAsString();
        }
	}

}//end of class