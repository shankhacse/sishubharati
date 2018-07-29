<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class routinemodel extends CI_Model{
	
	public function getAllweekDays(){
		$data = [];
		 $ids=array(6,7);
		$query = $this->db->select("")
				->from('week_master')
				->order_by('week_master.id')
				->where_not_in('week_master.id', $ids)
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