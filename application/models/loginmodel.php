<?php
class loginmodel extends CI_Model{
    
	public function verifyLogin($data)
	{
		$username = $data['username'];
		$password = $data['password'];
		$userDataInfo = array();
		$sql= "SELECT 
				*
				FROM administrator_user_master
				WHERE
				administrator_user_master.`username`='".$username."' AND 
				administrator_user_master.`password`='".$password."'";
				
		#echo $sql;
		 $query = $this->db->query($sql);
		# echo $this->db->last_query();
         if($query->num_rows()> 0){
            $row = $query->row();
            $userDataInfo =array(
                "username"=>$row->username,
                "userid"=>$row->id
            );

          return $userDataInfo;
        }
        else{
            return $userDataInfo=array();
        }
		
	}

/* get year desending order*/

public function getAcademicYear(){
		$data = [];
		$where = array('session_year.is_active' =>'Y' );
		$query = $this->db->select("*")
				->from('session_year')
				->where($where)
				->order_by('session_year.session_id','desc')
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