<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class studentactionmodel extends CI_Model{

		/* Get all student by class*/

public function getAllStudentsbyClass($session_id,$sel_class)
	{
	
		$data = array();
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y' 
					  );
		
			$query = $this->db->select("
										student_master.*,
										class_master.name as class_name,
										student_academic_details.class_roll
										")
					->from('student_master')
					
					->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->where($where)
					->get();

		#echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

/* get student ID list for certificate*/

		public function getStudentIdList($session_id){
		$data = [];
	
		$where = array(
						'student_academic_details.session_id' =>$session_id,
						'student_academic_details.is_active' =>'Y' 
					);

		$query = $this->db->select("*")
				->from('student_academic_details')	
				->where($where)
				->order_by('student_academic_details.student_uniq_id')
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


	public function getStudentAdmissionInformationbyId($academic_id,$session_id){

		$where = array(
							'student_academic_details.academic_id' =>$academic_id , 
							'student_academic_details.session_id' =>$session_id , 
						);
		
			$data = [];
			$query = $this->db->select("student_master.*,
										amcl.name as admission_class,
										cucl.name as current_class,
										student_academic_details.class_roll,
										category_master.category as student_category,
										blood_group.blood_group as student_blood_group,
										district.name as student_district,
										father_edu.qualification_type as father_education,
										mother_edu.qualification_type as mother_education,
										father_occ.occupation_type as father_occu,
										mother_occ.occupation_type as mother_occu,
										session_year.year,
										district.name as districname,
										uploaded_documents_all.random_file_name,
									    uploaded_documents_all.id as docid,
										states.name as statename
										")
					->from('student_master')
					->join('student_academic_details','student_academic_details.student_uniq_id=student_master.student_uniq_id','INNER')
					->join('class_master as amcl','amcl.id=student_master.class_id','INNER')
					->join('class_master as cucl','cucl.id=student_academic_details.class_id','INNER')
					->join('category_master','category_master.id=student_master.category','INNER')
					->join('blood_group','blood_group.id=student_master.blood_group','INNER')
					->join('district','district.id=student_master.distric_id','INNER')
					->join('qualification_master as father_edu','father_edu.qualification_id=student_master.father_edu','LEFT')
					->join('qualification_master as mother_edu','mother_edu.qualification_id=student_master.mother_edu','LEFT')
					->join('occupation_master as father_occ','father_occ.occupation_id=student_master.father_occupation','LEFT')

					->join('occupation_master as mother_occ','mother_occ.occupation_id=student_master.mother_occupation','LEFT')

					->join('session_year','session_year.session_id=student_academic_details.session_id','INNER')
					
					->join('states','states.id=district.state_id','INNER')
					->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = student_master.student_id and upload_from_module="Admission"','left')

					->where($where)
				    ->order_by('student_master.student_id')
				    ->limit(1);
					$query = $this->db->get();
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

}//end of class