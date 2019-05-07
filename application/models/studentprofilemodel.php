<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class studentprofilemodel extends CI_Model{
		/* get all teachers List*/

public function getAllStudenProfileList($session_id,$sel_class){
		$data = [];
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y',
						'uploaded_documents_all.document_type_id' =>1 // profile picture

					  );
		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid,
									blood_group.blood_group as student_blood_group
									")
				->from('student_master')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = student_master.student_id and upload_from_module="Admission"','left')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->join('blood_group','blood_group.id=student_master.blood_group','left')
				->order_by('student_academic_details.class_roll')
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



public function getAllStudenBirthCertifacateList($session_id,$sel_class){
		$data = [];
		$where = array(
						'student_academic_details.session_id' => $session_id, 
						'student_academic_details.class_id' => $sel_class,
						'student_academic_details.is_active' =>'Y',
						'uploaded_documents_all.document_type_id' => 6 // Birth certifacate

					  );
		$query = $this->db->select("student_master.*,
									class_master.name as class_name,
									student_academic_details.class_roll,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid,
									blood_group.blood_group as student_blood_group
									")
				->from('student_master')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = student_master.student_id and upload_from_module="Admission"','left')
				->join('student_academic_details','student_academic_details.student_uniq_id = student_master.student_uniq_id','INNER')
					->join('class_master','class_master.id = student_academic_details.class_id','INNER')
					->join('blood_group','blood_group.id=student_master.blood_group','left')
				->order_by('student_academic_details.class_roll')
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


}//end of class