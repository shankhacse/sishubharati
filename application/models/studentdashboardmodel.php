<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class studentdashboardmodel extends CI_Model{
    
	// getStudentAttendanceByMonth 
	// Count total no of days present in validity period month wise	
	public function getStudentAttendanceByMonth($studentId,$academicid)
	{
		$data = array();
		$sql = "SELECT COUNT(*) AS totalpresentDys,
 				DATE_FORMAT(attendance_details.taken_date,'%b') AS month_info,
 				DATE_FORMAT(attendance_details.taken_date, '%y') AS year_info,
                DATE_FORMAT(attendance_details.taken_date,'%Y' ) AS full_year_info 
				FROM `attendance_details` 
				WHERE attendance_details.student_uniq_id = '".$studentId."' 
				AND attendance_details.`academic_id`='".$academicid."' 
				AND attendance_details.`attendance_status`='P'
				GROUP BY DATE_FORMAT( attendance_details.taken_date,'%Y%m' )";
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
			{
				foreach($query->result() as $rows):
					$data[] = array(
						"totalpresentDys" => $rows->totalpresentDys,
						"month_info" => $rows->month_info,
						"year_info" => $rows->year_info,
						"full_year" => $rows->full_year_info
					); 
				endforeach;
			}
			return $data;
		
	}



	// Fetch detail record of single month
	public function getStudentAttendanceDetailByMonthAndYear($studentId,$academicid,$month,$year)
	{
		$data = array();
		$sql = "SELECT *
					FROM `attendance_details` WHERE attendance_details.student_uniq_id = '".$studentId."' 
				AND attendance_details.`academic_id`='".$academicid."'
					AND DATE_FORMAT(member_attendance.att_date,'%b')='".$month."' AND DATE_FORMAT(member_attendance.att_date,'%Y')=".$year;
		
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
			{
				foreach($query->result() as $rows):
					$data[] = array(
						
						"attendance_status" => $rows->attendance_status,
						"att_date" => $rows->taken_date
						
					); 
				endforeach;
			}
			return $data;
		
	}


}// end of class