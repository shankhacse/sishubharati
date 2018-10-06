<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class holidaysmodel extends CI_Model{
	
	public function getHolidaysList($session_id){
		$data = [];
		$where = array(
							'holidays.session_id' => $session_id 
						  );
		$query = $this->db->select("*")
				->from('holidays')
				->where($where)
				->order_by('holidays.date')
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