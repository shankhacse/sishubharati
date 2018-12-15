<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class classsubjectmodel extends CI_Model{
	
		public function getClassListForSubjectassign(){

		
			
			$data = [];
			$query = $this->db->select("class_master.*")
					->from('class_master')
					->join('class_subject_asign_master','class_subject_asign_master.class_master_id = class_master.id','LEFT')
					
					->where('class_subject_asign_master.class_master_id IS NULL')
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


public function getAllClassWiseSubjectDetails(){
		//$where = array('role_master.role_code!=>','ADMIN' );
		$data = [];
		$query = $this->db->select("class_subject_asign_master.*,
									class_master.name as classname
									")
				->from('class_subject_asign_master')
				->join('class_master','class_master.id = class_subject_asign_master.class_master_id','INNER')
				->get();
			
			#echo $this->db->last_query();
			/*if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }*/

	        if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data[] = array(
                        "classasignmasterData" => $rows,
                        "subjectMarksData" => $this->getClassSubjectDetails($rows->id)
                        
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
	}



public function getClassSubjectDetails($asign_master_id){
     $data = [];
    	$where = array(
			
			"class_subject_asign_details.asign_master_id"=>$asign_master_id
		);
        $data = array();
		$this->db->select("class_subject_asign_details.*,
							subject_master.subject
							")
				->from('class_subject_asign_details')
				->join('subject_master','subject_master.id = class_subject_asign_details.subject_id','INNER')
				->where($where);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
		if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
		
		
            return $data;
       
        
    }


    /* remain subject list for new subject add to a class*/

    	public function getRemainSubjectList($asign_master_id){

		
			
			$data = [];
			$query = $this->db->select("subject_master.*")
					->from('subject_master')
					->join('class_subject_asign_details','class_subject_asign_details.subject_id = subject_master.id AND class_subject_asign_details.asign_master_id ='.$asign_master_id,'LEFT')
					->where('class_subject_asign_details.subject_id IS NULL')
				
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

}// end of class