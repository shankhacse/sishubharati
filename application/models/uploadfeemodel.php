<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class uploadfeemodel extends CI_Model{
	
	public function getUploadFees($master_id){
		$data = [];
		$where = array(
					'upload_fee_details.upload_fee_master_id' =>$master_id,
					
					 );

		$query = $this->db->select("upload_fee_details.*,
									class_master.name as classname

			         ")
				->from('upload_fee_details')
				->join('class_master','class_master.id = upload_fee_details.class_id','INNER')
				->where($where)
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