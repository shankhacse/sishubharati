<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class feesinfomodel extends CI_Model{
	
	public function getMonthlyTutionFees($fee_master_id,$session_id){
		$data = [];
		$where = array(
					'monthly_tution_fees.fees_master_id' =>$fee_master_id,
					'monthly_tution_fees.session_id' =>$session_id
					 );

		$query = $this->db->select("monthly_tution_fees.*,
									class_master.name as classname

			         ")
				->from('monthly_tution_fees')
				->join('class_master','class_master.id = monthly_tution_fees.class_id','INNER')
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