<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class grademodel extends CI_Model{
	
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


}//end of class