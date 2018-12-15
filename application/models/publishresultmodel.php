<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class publishresultmodel extends CI_Model{
	
	public function termList($session_id){
		$data = [];
		$where = array('result_publish.session_id' =>$session_id);
		$query = $this->db->select("*")
				->from('result_publish')
				->join('session_year','session_year.session_id = result_publish.session_id','INNER')
				->where($where)
				->order_by('result_publish.id')
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

}// end of class