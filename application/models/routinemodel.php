<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class routinemodel extends CI_Model{
	
	public function getAllweekDays(){
		$data = [];
		 $ids=array(6,7);
		$query = $this->db->select("")
				->from('week_master')
				->order_by('week_master.id')
				->where_not_in('week_master.id', $ids)
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

	public function getClassListForRoutine(){
			
			$data = [];
			$query = $this->db->select("class_master.*")
					->from('class_master')
					->join('routine_master','routine_master.class_master_id = class_master.id','LEFT')
					->where('routine_master.class_master_id IS NULL')
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


	public function getRoutinebyRoutineMasterID($routin_mst_id,$session_id)
	{
		$data = array();
		$where_Ary = array(
			"routine_master.id" => $routin_mst_id,
			"routine_master.session_id" => $session_id
		);
		
		$this->db->select("routine_master.*,
						  routine_master.class_master_id as class_id,
						  week_master.days_name,
						  first_cls.subject as first_cls_sub,
						  second_cls.subject as second_cls_sub,
						  third_cls.subject as third_cls_sub,
						  fourth_cls.subject as fourth_cls_sub,
						  fifth_cls.subject as fifth_cls_sub,
						  sixth_cls.subject as sixth_cls_sub,
						  routine_details.first_cls_sub_id,
						  routine_details.second_cls_sub_id,
						  routine_details.third_cls_sub_id,
						  routine_details.fourth_cls_sub_id,
						  routine_details.fifth_cls_sub_id,
						  routine_details.sixth_cls_sub_id,
						  `routine_details`.`id` AS routine_details_id 

						")
				->from('routine_master')
				->join('routine_details','routine_details.routine_master_id = routine_master.id','INNER')
				->join('week_master','week_master.id = routine_details.week_master_id','INNER')
				->join('subject_master as first_cls','first_cls.id =routine_details.first_cls_sub_id','INNER')
				->join('subject_master as second_cls','second_cls.id =routine_details.second_cls_sub_id','INNER')
				->join('subject_master as third_cls','third_cls.id =routine_details.third_cls_sub_id','INNER')
				->join('subject_master as fourth_cls','fourth_cls.id =routine_details.fourth_cls_sub_id','INNER')
				->join('subject_master as fifth_cls','fifth_cls.id =routine_details.fifth_cls_sub_id','INNER')
				->join('subject_master as sixth_cls','sixth_cls.id =routine_details.sixth_cls_sub_id','INNER')
				->where($where_Ary)
				->order_by('routine_details.id');
		$query = $this->db->get();
		#q();
		if ($query->num_rows() > 0) 
		   {
			  foreach($query->result() as $rows)
			  {     $data[] = $rows;
					/*$data[] = array(
							"RoutineData" => $rows
							
						 );*/
			 }
		   }
		   return $data;
	}

public function getRoutinebyClass($class_id,$session_id)
	{
		$data = array();
		$where_Ary = array(
			"routine_master.class_master_id" => $class_id,
			"routine_master.session_id" => $session_id
		);
		
		$this->db->select("routine_master.*,
						  routine_master.class_master_id as class_id,
						  week_master.days_name,
						  first_cls.subject as first_cls_sub,
						  second_cls.subject as second_cls_sub,
						  third_cls.subject as third_cls_sub,
						  fourth_cls.subject as fourth_cls_sub,
						  fifth_cls.subject as fifth_cls_sub,
						  sixth_cls.subject as sixth_cls_sub,
						  routine_details.first_cls_sub_id,
						  routine_details.second_cls_sub_id,
						  routine_details.third_cls_sub_id,
						  routine_details.fourth_cls_sub_id,
						  routine_details.fifth_cls_sub_id,
						  routine_details.sixth_cls_sub_id,
						  `routine_details`.`id` AS routine_details_id 

						")
				->from('routine_master')
				->join('routine_details','routine_details.routine_master_id = routine_master.id','INNER')
				->join('week_master','week_master.id = routine_details.week_master_id','INNER')
				->join('subject_master as first_cls','first_cls.id =routine_details.first_cls_sub_id','INNER')
				->join('subject_master as second_cls','second_cls.id =routine_details.second_cls_sub_id','INNER')
				->join('subject_master as third_cls','third_cls.id =routine_details.third_cls_sub_id','INNER')
				->join('subject_master as fourth_cls','fourth_cls.id =routine_details.fourth_cls_sub_id','INNER')
				->join('subject_master as fifth_cls','fifth_cls.id =routine_details.fifth_cls_sub_id','INNER')
				->join('subject_master as sixth_cls','sixth_cls.id =routine_details.sixth_cls_sub_id','INNER')
				->where($where_Ary)
				->order_by('routine_details.id');
		$query = $this->db->get();
		#q();
		if ($query->num_rows() > 0) 
		   {
			  foreach($query->result() as $rows)
			  {     $data[] = $rows;
					/*$data[] = array(
							"RoutineData" => $rows
							
						 );*/
			 }
		   }
		   return $data;
	}

}//end of class