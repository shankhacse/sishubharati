<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class temperrankmodel extends CI_Model{
	
	public function getClassFromRankMasterList(){
		$session = $this->session->userdata('user_data');
		$data = [];
		$where = array('rank_master.session_id' =>$session['yid'] );
		$query = $this->db->select("*")
				->from('rank_master')
				->join('class_master','class_master.id = rank_master.class_id','INNER')
				->where($where)
				->order_by('class_master.id','desc')
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

	   public function updateSingleTableData($table,$data,$where){

        
        try {
            $this->db->trans_begin();
            //$this->db->where($where);
			$this->db->update($table, $data,$where);
			$this->db->last_query();
            //$affectedRow = $this->db->affected_rows();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                
                return FALSE;
            } else {
                $this->db->trans_commit();
                
                return TRUE;
            }
        } catch (Exception $exc) {
             return FALSE;
        }
    }


}//end of class