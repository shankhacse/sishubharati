<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class attendancemodel extends CI_Model{

	public function getStudentListByClass($class_id,$session_id){
			$where = array(
				'student_academic_details.class_id' => $class_id,
				'student_academic_details.session_id' =>$session_id, 
				'student_academic_details.is_active' =>'Y' 
			);
			$data = [];
			$query = $this->db->select("student_academic_details.*,
										student_master.name as student_name,
										class_master.name as class_name
								")
					->from('student_academic_details')
					->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','LEFT')
					->join('class_master','class_master.id = student_academic_details.class_id','LEFT')
					
					->where($where)
				    ->order_by('student_academic_details.class_roll')
					->get();
				//q();
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
				
		        return $data;
	       
		
	}

// for view attendance register
public function getAttendanceStudentListByDate($class_id,$session_id,$taken_date){
			$where = array(
				'attendance_master.class_id' => $class_id,
				'attendance_master.session_id' =>$session_id,
				'attendance_master.taken_date' =>$taken_date 
			);
			$data = [];
			$query = $this->db->select("*
								")
					->from('attendance_master')
					->where($where)
					->get();
				#q();
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data = array(
					"attendanceMasterData" => $rows,
					"attendanceDetailData" => $this->getAttendanceInfo($rows->id)
				);
					}
		             
		        }
				
		        return $data;
	       
		
	}


public function getAttendanceInfo($attendance_master_id)
	{
		$detailData = array();
		$where = array(
			"attendance_details.attendance_master_id" => $attendance_master_id,	
		);

		$this->db->select("attendance_details.*,
						 student_master.name as student_name")
				->from('attendance_details')
				->join('student_master','student_master.student_uniq_id = attendance_details.student_uniq_id','INNER')
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

	public function getMonthlyAttendance($month,$class_id,$session_id)
	{
		$data = array();
		$where = array('attendance_master.class_id' =>$class_id ,'attendance_master.session_id' =>$session_id  );
		$this->db->select("count(*) as total")
				->from('attendance_master')
				->where($where)
				->where("DATE_FORMAT(attendance_master.taken_date,'%m') =",$month);
		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	public function getSudentMonthlyAttendance($sel_month,$class_id,$session_id)
	{
		$data = array();
		$where = array(
						'student_academic_details.class_id' => $class_id,
						'student_academic_details.session_id' => $session_id,
						'student_academic_details.is_active' =>'Y'
						 );
		
		$this->db->select("student_academic_details.*,
			student_master.name as student_name")
				->from('student_academic_details')
				->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
				->where($where)
				->order_by("student_academic_details.class_roll", "asc");;
				
		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				//$data[] = $rows;
					$data[] = array(
					"attendanceMasterData" => $rows,
					"presentCount"=>$this->getCountByTag($sel_month,$rows->student_uniq_id,$rows->academic_id,'P'),
					"absentCount"=>$this->getCountByTag($sel_month,$rows->student_uniq_id,$rows->academic_id,'A')
				);
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

public function getCountByTag($month,$student_uniq_id,$academic_id,$tag)
	{
		$data = array();
		$where = array(
						'attendance_details.student_uniq_id' =>$student_uniq_id ,
						'attendance_details.academic_id' =>$academic_id, 
						'attendance_details.attendance_status' =>$tag
						 );

		$this->db->select("count(*) as total")
				->from('attendance_details')
				->where($where)
				->where("DATE_FORMAT(attendance_details.taken_date,'%m') =",$month);

		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


public function getAttendanceDtlbyStudent($month,$student_uniq_id,$academic_id)
	{
		$data = array();
		$where = array(
						'attendance_details.student_uniq_id' =>$student_uniq_id ,
						'attendance_details.academic_id' =>$academic_id, 
						
						 );

		$this->db->select("*")
				->from('attendance_details')
				->where($where)
				->where("DATE_FORMAT(attendance_details.taken_date,'%m') =",$month);

		$query = $this->db->get();
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



	public function getSudentYearlyAttendance($class_id,$session_id)
	{
		$data = array();
		$where = array(
						'student_academic_details.class_id' => $class_id,
						'student_academic_details.session_id' => $session_id,
						'student_academic_details.is_active' =>'Y'
						 );
		
		$this->db->select("student_academic_details.*,
			student_master.name as student_name")
				->from('student_academic_details')
				->join('student_master','student_master.student_uniq_id = student_academic_details.student_uniq_id','INNER')
				->where($where)
				->order_by("student_academic_details.class_roll", "asc");;
				
		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				//$data[] = $rows;
					$data[] = array(
					"attendanceMasterData" => $rows,

					"janopenDays"=>$this->getMonthlyAttendance('01',$class_id,$session_id),
					"JanpresentCount"=>$this->getCountByTag('01',$rows->student_uniq_id,$rows->academic_id,'P'),
					"janabsentCount"=>$this->getCountByTag('01',$rows->student_uniq_id,$rows->academic_id,'A'),

					"febopenDays"=>$this->getMonthlyAttendance('02',$class_id,$session_id),
					"febpresentCount"=>$this->getCountByTag('02',$rows->student_uniq_id,$rows->academic_id,'P'),
					"febabsentCount"=>$this->getCountByTag('02',$rows->student_uniq_id,$rows->academic_id,'A'),

					"maropenDays"=>$this->getMonthlyAttendance('03',$class_id,$session_id),
					"marpresentCount"=>$this->getCountByTag('03',$rows->student_uniq_id,$rows->academic_id,'P'),
					"marabsentCount"=>$this->getCountByTag('03',$rows->student_uniq_id,$rows->academic_id,'A'),
					
					"apropenDays"=>$this->getMonthlyAttendance('04',$class_id,$session_id),
					"aprpresentCount"=>$this->getCountByTag('04',$rows->student_uniq_id,$rows->academic_id,'P'),
					"aprabsentCount"=>$this->getCountByTag('04',$rows->student_uniq_id,$rows->academic_id,'A'),
					
					"mayopenDays"=>$this->getMonthlyAttendance('05',$class_id,$session_id),
					"maypresentCount"=>$this->getCountByTag('05',$rows->student_uniq_id,$rows->academic_id,'P'),
					"mayabsentCount"=>$this->getCountByTag('05',$rows->student_uniq_id,$rows->academic_id,'A'),
					
					"junopenDays"=>$this->getMonthlyAttendance('06',$class_id,$session_id),
					"junpresentCount"=>$this->getCountByTag('06',$rows->student_uniq_id,$rows->academic_id,'P'),
					"junabsentCount"=>$this->getCountByTag('06',$rows->student_uniq_id,$rows->academic_id,'A'),

					"julopenDays"=>$this->getMonthlyAttendance('07',$class_id,$session_id),
					"julpresentCount"=>$this->getCountByTag('07',$rows->student_uniq_id,$rows->academic_id,'P'),
					"julabsentCount"=>$this->getCountByTag('07',$rows->student_uniq_id,$rows->academic_id,'A'),

					"augopenDays"=>$this->getMonthlyAttendance('08',$class_id,$session_id),
					"augpresentCount"=>$this->getCountByTag('08',$rows->student_uniq_id,$rows->academic_id,'P'),
					"augabsentCount"=>$this->getCountByTag('08',$rows->student_uniq_id,$rows->academic_id,'A'),

					"sepopenDays"=>$this->getMonthlyAttendance('09',$class_id,$session_id),
					"seppresentCount"=>$this->getCountByTag('09',$rows->student_uniq_id,$rows->academic_id,'P'),
					"sepabsentCount"=>$this->getCountByTag('09',$rows->student_uniq_id,$rows->academic_id,'A'),

					"octopenDays"=>$this->getMonthlyAttendance('10',$class_id,$session_id),
					"octpresentCount"=>$this->getCountByTag('10',$rows->student_uniq_id,$rows->academic_id,'P'),
					"octabsentCount"=>$this->getCountByTag('10',$rows->student_uniq_id,$rows->academic_id,'A'),

					"novopenDays"=>$this->getMonthlyAttendance('11',$class_id,$session_id),
					"novpresentCount"=>$this->getCountByTag('11',$rows->student_uniq_id,$rows->academic_id,'P'),
					"novabsentCount"=>$this->getCountByTag('11',$rows->student_uniq_id,$rows->academic_id,'A'),

					"decopenDays"=>$this->getMonthlyAttendance('12',$class_id,$session_id),
					"decpresentCount"=>$this->getCountByTag('12',$rows->student_uniq_id,$rows->academic_id,'P'),
					"decabsentCount"=>$this->getCountByTag('12',$rows->student_uniq_id,$rows->academic_id,'A'),
				);
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}


	public function getMonthlyAttendanceDetails($month,$class_id,$session_id)
	{
		$data = array();
		$where = array('attendance_master.class_id' =>$class_id ,'attendance_master.session_id' =>$session_id  );
		$this->db->select("attendance_master.*,administrator_user_master.username,class_master.name as classname,session_year.year,teachers.name as teachername")
				->from('attendance_master')
				->join('class_master','class_master.id = attendance_master.class_id','INNER')
				->join('administrator_user_master','administrator_user_master.id = attendance_master.created_by','left')
				->join('teachers','teachers.teacher_id = attendance_master.created_by','left')
				->join('session_year','session_year.session_id = attendance_master.session_id','INNER')
				->where($where)
				->where("DATE_FORMAT(attendance_master.taken_date,'%m') =",$month);
		$query = $this->db->get();
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


	public function getAttendanceDetailsByMasterid($attendance_master_id)
	{
		$data = array();
		$where = array(
						'attendance_details.attendance_master_id' =>$attendance_master_id
						 );

		$this->db->select("attendance_details.*,student_master.name as student_name")
				->from('attendance_details')
				->join('student_master','student_master.student_uniq_id = attendance_details.student_uniq_id','INNER')
				->where($where);

		$query = $this->db->get();
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
}//end of class