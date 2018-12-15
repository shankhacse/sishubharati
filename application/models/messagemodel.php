<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class messagemodel extends CI_Model{
	
	public function getMessageList(){
		$data = [];
		
		$query = $this->db->select("*")
				->from('message')
				->order_by('message.id','desc')
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

	public function replyPending()
	{
		$where = array('message.is_replied' =>'N');
		$this->db->select('*')
				->from('message')
				->where($where);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}


}//end of class