<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class discountmodel extends CI_Model{
	
	public function insertTestDiscount($dataarry)
	{
		 $insert_id = 0;
		try
		{
			$this->db->insert('test_discounts', $dataarry);
   			$insert_id = $this->db->insert_id();
			return  $insert_id;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}


	public function getTestDiscountList($centerID)
	{
		$where = array("test_discounts.centre_id"=>$centerID);
		$data = [];
		try{
        	$this->db->select("test_discounts.id,
							test_discounts.`centre_id`,
							test_discounts.`test_id`,
							test_discounts.`valid_from`,
							test_discounts.`valid_upto`,
							test_discounts.`discount_rate`,
							test_discounts.`is_active`,
							investigations_master.`name`,
							investigations_master.`code`,
							investigations_master.`rate`")
						->from('test_discounts')
						->join('investigations_master','investigations_master.id = test_discounts.test_id','INNER')
						->where($where)
						->order_by('test_discounts.valid_from','ASC');
			
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }
		
            return $data;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}
	
	
}