<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class activitylogmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		
	}
	
	
	public function getAllActivitylog(){
		$data = [];
		$query = $this->db->select("activity_log.*,
							administrator_user_master.username")
				->from('activity_log')
				->join('administrator_user_master','administrator_user_master.id = activity_log.user_id','INNER')
				
				->order_by('activity_log.id',"DESC")
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

	public function getAllActivityReport(){
		$data = [];
		$query = $this->db->select("user_activity_report.*,
							administrator_user_master.username")
				->from('user_activity_report')
				->join('administrator_user_master','administrator_user_master.id = user_activity_report.user_id','INNER')
				
				->order_by('user_activity_report.id',"DESC")
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


}// end of file