<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentdashboard extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('admissionmodel','admmodel',TRUE);
	    $this->load->model('routinemodel','routinemodel',TRUE);
	    $this->load->model('studentdashboardmodel','studentdash',TRUE);
	    $this->load->model('paymentomodel','paymentomodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/ds-home/student_home';
			
			$result = [];
			$header = "";
			$where = array('student_master.student_uniq_id' =>$session['studentID']);
			$result['studentData']= $this->commondatamodel->getSingleRowByWhereCls('student_master',$where);

			$result['academicData']=$this->studentdash->getStudentAcademicDetailsbyId($session['academicID']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function test()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/ds-home/test';
			
			$result = [];
			$header = "";
			$where = array('student_master.student_uniq_id' =>$session['studentID']);
			$result['studentData']= $this->commondatamodel->getSingleRowByWhereCls('student_master',$where);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function profile()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$result = [];
			$header = "";

			$page = 'student/dashboard/profile/student_profile_view';
				$data['documentDetailData'] = $this->admmodel->getStudentProfilePicture($session['student_autoid'],"Admission");
				
				$data['uplodedFolder'] = "admission_upload" ;

				$where = array(
								'student_master.student_id' => $session['student_autoid'], 
								'student_academic_details.session_id' => $session['academic_session_id'] 
							);
				$data['studentdata'] = $this->admmodel->getStudentAdmissionInformationbyId($where);
			
			
			studentbody_method($data, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


	public function class_routine()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/class_routine/class_routine_data.php';
			
			$result = [];
			$header = "";
			$where = array('student_academic_details.academic_id' =>$session['academicID']);
			$studentData= $this->commondatamodel->getSingleRowByWhereCls('student_academic_details',$where);

			$student_class=$studentData->class_id;
			$student_session_id=$studentData->session_id;


			$where_class = array('class_master.id' =>$student_class);
			$classData= $this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);
			$result['studentClass']=$classData->name;


			$where_session = array('session_year.session_id' =>$student_session_id);
			$sessionData= $this->commondatamodel->getSingleRowByWhereCls('session_year',$where_session);
			$result['year']=$sessionData->year;


			$result['routineList'] = $this->routinemodel->getRoutinebyClass($student_class,$student_session_id); 
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}


public function attendance()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/attendance/student_attendence_view';
			
			$result = [];
			$header = "";
			 
			$result['studentAttendance']= $this->studentdash->getStudentAttendanceByMonth($session['studentID'],$session['academicID']);
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
		
	}

	public function attendancedetailbymonth()
	{
		if($this->session->userdata('student_data'))
		{
			$session = $this->session->userdata('student_data');
			$page = 'student/dashboard/attendance/student_attendence_detail_view';
			
			$result = [];
			$header = "";
			
			$month = $this->uri->segment(3);
			$year = $this->uri->segment(4);
			
			
			$result['studentAttDetail'] = $this->studentdash->getStudentAttendanceDetailByMonthAndYear($session['studentID'],$session['academicID'],$month,$year);
			$result['month'] = $month;
			$result['year'] = $year;
			
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}
 

/* get student paymeny history working on 30.09.2018*/
	public function payments()
	{
		$session = $this->session->userdata('student_data');
		if($this->session->userdata('student_data') )
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			$header='';
			$result['paymentList'] = $this->paymentomodel->getPaymentList($session['academicID']);
			  
			//pre($result['paymentList']);exit;
			$page = "student/dashboard/payments/payment_history_list_data";
			studentbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('studentlogin','refresh');
		}
	}

	/* get bill details data*/		
	public function getBillDetailData()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$data = [];
			

			$page = 'student/dashboard/payments/bill_details_partial_modal_view.php';
			$paymentid = $this->input->post('paymentid');
			$paymentfor = $this->input->post('paymentfor');
			$data['billno'] = $this->input->post('billno');

			$where = array('payment_master.payment_master_id' => $paymentid);
			$paymentData=$this->commondatamodel->getSingleRowByWhereCls('payment_master',$where);

			$bill_master_id=$paymentData->bill_master_id;
			$data['student_uniq_id']=$paymentData->student_uniq_id;


			
			$data['billDetails']=$this->paymentomodel->getBillDetailsData($bill_master_id);
			$BillDetailView = $this->load->view($page,$data);
			

			echo $BillDetailView;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


}// end of class