<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class transferstudentmodel extends CI_Model{

	public function getClassListForTransfer($sessionid){
			$joinand = 'AND transfer_master.`session_id`='.'".$sessionid."';
			$data = [];
			$query = $this->db->select("class_master.*")
					->from('class_master')
					->join('transfer_master','transfer_master.class_master_id = class_master.id AND transfer_master.session_id='.$sessionid,'LEFT')
					->where('transfer_master.class_master_id IS NULL')
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
	
	public function getStudentForTransfer($rank_master_id){
		$data = [];
		$where = array('rank_details.rank_master_id' =>$rank_master_id );
		
		$query = $this->db->select("rank_details.*,

										")
				->from('rank_details')
				
				->where($where)
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


	public function getTransferStudentList($transfer_master_id){
		$data = [];
		$where = array('transfer_details.transfer_master_id' =>$transfer_master_id );
		
		$query = $this->db->select("transfer_details.*,
									frmcls.name as frmclsname,
									nxtcls.name as nxtclsname,
									frmses.year as frmyear,
									nxtses.year as nxtyear,
									student_master.name as student_name

										")
				->from('transfer_details')
				->join('student_master','student_master.student_uniq_id=transfer_details.student_uniq_id','INNER')
				->join('class_master as frmcls','frmcls.id=transfer_details.from_class_id','INNER')
				->join('class_master as nxtcls','nxtcls.id=transfer_details.next_class_id','INNER')
				->join('session_year as frmses','frmses.session_id=transfer_details.from_session_id','INNER')
				->join('session_year as nxtses','nxtses.session_id=transfer_details.next_session_id','INNER')
				
				->where($where)
				->order_by('transfer_details.rank')
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