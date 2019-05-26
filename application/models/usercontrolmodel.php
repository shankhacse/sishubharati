<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class usercontrolmodel extends CI_Model{
	
	public function userList(){
		$data = [];
		
		$query = $this->db->select("*")
				->from('administrator_user_master')
				
				->order_by('administrator_user_master.id')
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


}