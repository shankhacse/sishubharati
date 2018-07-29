<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class classmastermodel extends CI_Model{
	
	public function getAllClass(){
		$data = [];
		$query = $this->db->select("
						class_master.id,
						class_master.name,
						class_master.class_code,
						class_master.is_active,
						admisson_type.id as admid,
						admisson_type.type

			         ")
				->from('class_master')
				->join('admisson_type','admisson_type.id = class_master.admisson_type_id','INNER')
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