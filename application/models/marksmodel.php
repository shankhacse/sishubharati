<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class marksmodel extends CI_Model{

		public function getStudentInfo($academic_id){
			$where = array(
				'student_academic_details.academic_id' => $academic_id
				 
			);
			$data = [];
			$query = $this->db->select("student_academic_details.*,
										student_master.name as student_name,
										class_master.name as class_name
								")
					->from('student_academic_details')
					->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					
					->where($where)
				    ->limit(1)
					->get();
				#q();
				if($query->num_rows()> 0)
				{
		           $row = $query->row();
		           return $data = $row;
		             
		        }
				else
				{
		            return $data;
		        }
	       
		
	}


	/* get marks details for individuals*/

	public function getMarksDetails($marks_master_id){
     $data = [];
    	$where = array(
			
			"marks_details.marks_master_id"=>$marks_master_id
		);
        $data = array();
		$this->db->select("marks_details.*,
							subject_master.subject,
							subject_master.id as subjectid
							")
				->from('marks_details')
				->join('subject_master','subject_master.id = marks_details.subject_id','INNER')
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


   public function getUploadedExamPapers($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_exam_papers.upload_from_module_id" => $moduleID,
			"uploaded_exam_papers.upload_from_module" => $moduleTag
		);

		$this->db->select("uploaded_exam_papers.*,documents_upload_type.document_type")
				->from('uploaded_exam_papers')
				->join('documents_upload_type','documents_upload_type.id = uploaded_exam_papers.document_type_id','INNER')
				->where($where);

		$query = $this->db->get();
		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$detailData[] = $rows;
				
            }
            return $detailData;
        }
		else
		{
             return $detailData;
        }
	}



/* highest marks 30.11.2018*/

	public function getHighestMarks($classid,$subjectid,$term,$sessionid){
		$data = "";
		
		$sql="SELECT MAX(marks_details.obtain_total_marks) AS highest
			FROM marks_details
			WHERE marks_details.term='".$term."'
			AND marks_details.class_id='".$classid."'
			AND marks_details.subject_id='".$subjectid."'
			AND marks_details.session_id='".$sessionid."'";
		
		$query = $this->db->query($sql);
		
			#echo $this->db->last_query();
		
		
			
			if($query->num_rows()> 0)
			{
                 $row = $query->row();
          
					$data = $row->highest;
				
	             
                        }
			
	        return $data;
	       
	}
}//end of class