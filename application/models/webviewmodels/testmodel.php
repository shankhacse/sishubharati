<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class testmodel extends CI_Model{

	public function __construct()
	{
		 $this->load->model('commondatamodel','',TRUE);
	}



	public function GetAllTest()
	{
		$data = [];
		try{
         	   
         	    $procedure = "SELECT 
						investigations_master.`id` AS investigatioID,
						investigations_master.`name` AS investigationName,
						investigations_master.`center_id`,
						investigations_master.`code`,
						pincode_master.`id` AS pincodeID
						FROM `investigations_master`
						INNER JOIN `center_master`
						ON `center_master`.`id` = investigations_master.`center_id`
						INNER JOIN `pincode_master`
						ON `pincode_master`.`id` = center_master.`pincode_id`
						WHERE investigations_master.`is_active`='Y'
						GROUP BY investigations_master.`name`
						ORDER BY investigations_master.`name` ";


			   $query = $this->db->query($procedure);

			    if ($query->num_rows() > 0) 
			    {
	        	    foreach ($query->result() as $rows) 
	        	    {
						$data[] = $rows;
	        	    }
				}
				else
				{
					$data =[];
				}

				return $data;
			}
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}


	public function getInvestigationsByPin($pincode)
	{
		$data = [];
		try{
         	   
         	  // $procedure = "CALL SP_GetInvestigationByPin('".$pincode."')";

         	   $procedure = "SELECT 
						investigations_master.`id` AS investigatioID,
						investigations_master.`name` AS investigationName,
						investigations_master.`center_id`,
						investigations_master.`code`,
						pincode_master.`id` AS pincodeID
						FROM `investigations_master`
						INNER JOIN `center_master`
						ON `center_master`.`id` = investigations_master.`center_id`
						INNER JOIN `pincode_master`
						ON `pincode_master`.`id` = center_master.`pincode_id`
						WHERE pincode_master.`pincode`= '".$pincode."'
						AND investigations_master.`is_active`='Y'
						ORDER BY investigations_master.`name`";


			   $query = $this->db->query($procedure);

			    if ($query->num_rows() > 0) 
			    {
	        	    foreach ($query->result() as $rows) 
	        	    {
						$data[] = $rows;
	        	    }
				}
				else
				{
					$data =[];
				}

				return $data;
			}
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	

	public function repopulateInvestigation($notinval)
	{
		$data = [];
		try{
         	   //$procedure = "CALL SP_GetAllCountry('".$param."')";
         	   // $procedure = "CALL SP_GetRefreshedInvestigationByPin('".$pincode."','".$notinval."')";

         	   $procedure = "SELECT 
					investigations_master.`id` AS investigatioID,
					investigations_master.`name` AS investigationName,
					investigations_master.`center_id`,
					investigations_master.`code`,
					pincode_master.`id` AS pincodeID
					FROM `investigations_master`
					INNER JOIN `center_master`
					ON `center_master`.`id` = investigations_master.`center_id`
					INNER JOIN `pincode_master`
					ON `pincode_master`.`id` = center_master.`pincode_id`
					WHERE 
					investigations_master.`name` NOT IN ($notinval)
					AND investigations_master.`is_active`='Y'
					GROUP BY investigations_master.`name`
					ORDER BY investigations_master.`name`";


			   $query = $this->db->query($procedure);

			  // echo $this->db->last_query();

			    if ($query->num_rows() > 0) 
			    {
	        	    foreach ($query->result() as $rows) 
	        	    {
						$data[] = $rows;
	        	    }
				}
				else
				{
					$data =[];
				}

				return $data;
			}
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}



   /*
	* @method = getCenterInfoByPinAndTest
	* @param = String pincode,String testcodes
	* @date = 05.04.2018
	* @By = Mithilesh
	*
	*/

	public function getCenterInfoByPinAndTest($pincode,$code_in,$testnames)
	{
		try
		{
			$data = array();
			$where_ary = array(
				"pincode_master.pincode" => $pincode
			);
			$where_or_like_tests = "";
			for($i=0; $i<sizeof($testnames);$i++)
			{
				$where_or_like_tests.= "investigations_master.name LIKE '".$testnames[$i]."' OR ";
			}
			$where_or_like_tests = rtrim($where_or_like_tests,' OR ');
			$sql = "SELECT `center_master`.`id` AS centerID, 
					`center_master`.`center_name`,
					`center_master`.`latitude`,
					`center_master`.`longitude`,
					`center_master`.`nearest_landmark`,
					`center_master`.`center_full_add`,
					`center_master`.`contact_no`,
					`pincode_master`.`pincode` AS centerPincode,
					`district`.`name` AS districtName FROM (`center_master`) 
					INNER JOIN `pincode_master` ON `pincode_master`.`id` = `center_master`.`pincode_id` 
					INNER JOIN `district` ON `district`.`id` = `pincode_master`.`district_id` 
					INNER JOIN `investigations_master` ON `investigations_master`.`center_id` = `center_master`.`id` 
					WHERE $where_or_like_tests   GROUP BY `center_master`.`id`";
			$query = $this->db->query($sql);	

			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
	            foreach ($query->result() as $rows)
				{
					$data[] = array(
						"centerMasterData" => $rows,
						"centerFacilitiesData" =>$this->getCenterFacilities($rows->centerID),
						"centerTimingData" =>$this->getCenterTimings($rows->centerID),
						"centerUploadedDocsData" => $this->getCenterUploadedDocuments($rows->centerID,"CENTER"),
						"testPriceInfo" => $this->getPriceInfoByCenterTests($rows->centerID,$testnames,$where_or_like_tests),
						"testInfoForCheckout" => $this->getTestInfoForCheckoutOpt($rows->centerID,$where_or_like_tests),
						"centerdistance" => $this->getCenterDistanceFromUser($pincode,$rows->centerPincode,'K')
					); 
					
	            }
	            return $data;
	             
	        }
			else
			{
	             return $data;
	        }
		}
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	private function getTestInfoForCheckoutOpt($centerid,$or_likes)
	{
		$data = [];
		$sql = "SELECT 
					  investigations_master.`id`,
					  investigations_master.`code`,
					  investigations_master.`name`,
					  investigations_master.`rate`,
					  investigations_master.`center_id`
					FROM
					  `investigations_master` WHERE investigations_master.`center_id`=".$centerid." AND ($or_likes)  ORDER BY investigations_master.`name` ";

		$query = $this->db->query($sql);	
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }

        return $data;
	}

	/*-----------------------------------
	* getPriceInfoByCenterTests(centerid,testcodes,orlikes)
	*------------------------------------
	*/

	public function getPriceInfoByCenterTests($centerid,$tests,$or_likes)
	{	
		try
		{
			$data=[];
			 $sql = "SELECT 
					  investigations_master.`id`,
					  investigations_master.`code`,
					  investigations_master.`name`,
					  investigations_master.`rate`,
					    investigations_master.`center_id`
					FROM
					  `investigations_master` WHERE investigations_master.`center_id`=".$centerid." AND ($or_likes)  ORDER BY investigations_master.`name` ";

			$query = $this->db->query($sql);	

			if($query->num_rows()> 0)
			{
				$actual_price = 0;
				$discount_rate = 0;
				$discount_amt = 0;
				$aftre_disc_price = 0;

				$total_actual_price = 0;
				$total_disc_price = 0;
				$aftre_disc_price_total = 0;
				$saved_percentg=0;

	            foreach ($query->result() as $rows)
				{
					$discount = $this->getTestDiscountsRate($centerid,$rows->id);
					$discount_amt = $rows->rate*$discount/100;
					$aftre_disc_price = $rows->rate - $discount_amt;

					$total_actual_price+=$rows->rate;
					$aftre_disc_price_total+=$aftre_disc_price;
					$total_disc_price+=$discount_amt;
	            }
	          
	          	if($total_disc_price>0 && $total_actual_price>0){
	          		$saved_percentg = $total_disc_price*100/$total_actual_price;
	          	}


	            $data = [
	            	"total_actual_price" => $total_actual_price,
	            	"aftre_disc_price_total" => $aftre_disc_price_total,
	            	"total_disc_price" => $total_disc_price,
	            	"saved_percentg" => number_format((float)$saved_percentg, 2, '.', '')
	            ];
	             
	        }

	        return $data;
			

		}
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
		
	}


	public function getTestDiscountsRate($centerid,$testid)
	{
		$discount_rate = 0;
		$currdt = date("Y-m-d");
		$sql="SELECT 
			test_discounts.`id`,
			test_discounts.`centre_id`,
			test_discounts.`test_id`,
			test_discounts.`discount_rate`
			FROM `test_discounts` WHERE `test_discounts`.`centre_id`=".$centerid."
			AND `test_discounts`.`test_id` = ".$testid." 
			AND test_discounts.`valid_from` <= '".$currdt."' AND test_discounts.`valid_upto` >= '".$currdt."'
			AND test_discounts.`is_active`='Y'";

			$query = $this->db->query($sql);	

			if($query->num_rows()> 0)
			{
				 $row = $query->row();
	     		 $discount_rate = $row->discount_rate;
	        }
			return $discount_rate;
	}

	/* -------------------------------
	*	getCenterFacilities(centerid)
	* --------------------------------
	*/
	public function getCenterFacilities($centerID)
	{
		$where = array("center_facilities_detail.center_id"=>$centerID);
		$data = [];
		try{
        	$this->db->select("center_facilities_detail.`id` AS centerFacilityDtlID,
					center_facilities_detail.`facility_id` AS facilityID,
					facility_master.`title` AS facilityname,
					facility_master.`icon_random_name`
					")
				->from('center_facilities_detail')
				->join('facility_master','facility_master.id = center_facilities_detail.facility_id','INNER')
				->where($where)
				->order_by('center_facilities_detail.facility_srl_no','ASC');
			
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }
		
            return $data;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	/* -------------------------------
	*	getCenterTimings(centerid)
	* --------------------------------
	*/

	public function getCenterTimings($centerID)
	{
		$where = array("center_timing_detail.center_id"=>$centerID);
		$data = [];
		try{
        	$this->db->select("center_timing_detail.`id` AS centertimngDtlID,
							center_timing_detail.`opening_time`,
							center_timing_detail.`close_time`,
							center_timing_detail.`is_close`,
							week_master.`days_name`,
							week_master.`short_name` AS dayshort_name
							")
						->from('center_timing_detail')
						->join('week_master','week_master.id = center_timing_detail.day_id','INNER')
						->where($where)
						->order_by('center_timing_detail.day_id','ASC');
			
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }
		
            return $data;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	/* -------------------------------
	*	getCenterUploadedDocuments(centerid)
	* --------------------------------
	*/


	public function getCenterUploadedDocuments($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_documents_all.upload_from_module_id" => $moduleID,
			"uploaded_documents_all.upload_from_module" => $moduleTag
		);

		$this->db->select("*")
				->from('uploaded_documents_all')
				->join('documents_upload_type','documents_upload_type.id = uploaded_documents_all.document_type_id','INNER')
				->where($where);
		$query = $this->db->get();
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


	/*
	* getCheckoutTestByCenter
	*/

	public function getCheckoutTestByCenter($center_id,$testids_ary)
	{
		$detailData = array();
		$where = array(
			"investigations_master.center_id" => $center_id
			
		);

		$this->db->select("*")
				->from('investigations_master')
				->where($where)
				->where_in('investigations_master.id', $testids_ary);
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$detailData[] = [
					"checkoutTestNames" => $rows,
					"discountRate" => $this->getTestDiscountsRate($center_id,$rows->id)
				];
				
            }
            return $detailData;
        }
		else
		{
             return $detailData;
        }
	}


	public function getCenterDistanceFromUser($userpin,$centerpin,$unit)
	{
		// User Longitude & latitude
		$userLocation = $this->getLatandLong($userpin);
		$userlatitude = $userLocation['lat'];
		$userlongitude = $userLocation['lng'];

		// Center Longitude & latitude
		$centerLocation = $this->getLatandLong($centerpin);
		$centerlatitude = $centerLocation['lat'];
		$centerlongitude = $centerLocation['lng'];

		 $theta = $userlongitude - $centerlongitude;
		  //$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = sin(deg2rad($userlatitude)) * sin(deg2rad($centerlatitude)) +  cos(deg2rad($userlatitude)) * cos(deg2rad($centerlatitude)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);

		  if ($unit == "K") {
		    return ($miles * 1.609344);
		  } 
		  else if ($unit == "N")
		  {
		      return ($miles * 0.8684);
		  }
		  else 
		  {
		        return $miles;
		  }
	}

	private function getLatandLong($zip)
	{

		 //$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&amp;sensor=false";
		 $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&amp;sensor=false&key=AIzaSyB7r-VJ096fNh5SngDRncZE8EquwOI_8p8";
		 $result_string = file_get_contents($url);
		 $result = json_decode($result_string, true);

		

		 $result1[]=$result['results'][0];
		 $result2[]=$result1[0]['geometry'];
		 $result3[]=$result2[0]['location'];

		 return $result3[0];
		 
	}


	 /************************************************************/
	/************************CHECKOUT***************************/
   /**********************************************************/


   public function getTestDeliveryDates($values)
   {
   		
   		$testcenter_id = $values['hdncenterid'];
   		$date_of_test = $values['dateofTest'];
   		$test_date = str_replace('/', '-', $date_of_test);

   		$detailData = array();
		$where = array("investigations_master.center_id" => $testcenter_id);

		$this->db->select("*")
				->from('investigations_master')
				->where($where)
				->where_in('investigations_master.id', $values['investigationtestIDS']);

		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$detailData[] = [
					"testID" => $rows->id,
					"deliveryDate" => $this->getDeliveryDate($rows->deliver_in_days,$test_date)
				];
				
            }

            return $detailData;
        }
		else
		{
             return $detailData;
        }

   }

   private function getDeliveryDate($days_no,$test_date)
   {
   		$deliver_date = "";
   		if($days_no>0)
   		{
			   $deliver_date = date('Y-m-d', strtotime($test_date. ' + '.$days_no.' days'));
			   return date("d/m/Y",strtotime($deliver_date));
		}
		else{
			return date("d/m/Y",strtotime($test_date));
		}
		   

   		
   }

   public function insertOrdersData($inserDatas)
   {
   	  try
		{
			$this->db->trans_begin();
        	$customer_master = []; 
			$order_master = [];
			$order_detail = [];
			
			$customer_id = 0;
			$curr_dt = date("Y-m-d H:i:s");

			$master_phone = trim(htmlspecialchars($inserDatas['master_phone']));

			$existing_customer_id = $this->getCustomerExistingData($master_phone);

			if(isset($inserDatas['cusdob']))
				{
					$dob = str_replace('/', '-', $inserDatas['cusdob']);
					$dob = date("Y-m-d",strtotime($dob));
				}
				else
				{
					$dob = NULL;
				}

			if($existing_customer_id>0)
			{
				$customer_id = $existing_customer_id;
			}
			else
			{
				
				
				$serial_data = $this->generateCustomerUniqID("CUSTOMER","C");
				$customer_master = [
					"customer_uniq_id" => $serial_data['uniqno'], 
					"name" => $inserDatas['name'],
					"phone" => $master_phone,
					"alternate_phone" => $inserDatas['add_alternate_phone'],
					"dob" => $dob,
					"email" => $inserDatas['cusemail'],
					"gender" => $inserDatas['cusgender'],
					"pincode" => $this->getPinIDByByPinCode($inserDatas['chkout_user_pin']),
					"locality" => $inserDatas['address_locality'],
					"address" => $inserDatas['full_address'],
					"city" => $inserDatas['address_city'],
					"state_id" => $this->getStatesIDByStateName($inserDatas['chkout_user_state']),
					"landamrk" => $inserDatas['address_landmark'],
					"created_on" => $curr_dt,
					"updated_on" => $curr_dt
				];

				$customer_ins = $this->db->insert('customer_master', $customer_master);
				$customer_id =  $this->db->insert_id();
				$updserial = $this->updateSerialNumber($serial_data['nextserial'],"CUSTOMER");
			}


			$uniq_order_id = $this->getUniqOrderID($customer_id);


		
			// Insert Into Order Master
			$date_of_test = str_replace('/', '-', $inserDatas['dateofTest']);
			$order_master = [
				"customer_id" => $customer_id,
				"date_of_test" => date("Y-m-d",strtotime($date_of_test)),
				"time_of_tets" => date("H:i:s",strtotime($inserDatas['timeofTest'])),
				"delivery_mode" => $inserDatas['deliveryMode'],
				"test_done_for" => $inserDatas['testForMode'],
				"center_master_id" => $inserDatas['hdncenterid'],
				"uniq_order_id" => $uniq_order_id,
				"orderd_on" => $curr_dt,
				"patient_name" => $inserDatas['cusname'],
				"patient_contact" => $inserDatas['patientphone'],
				"patient_dob" => $dob,
				"patient_age" => $inserDatas['cusage'],
				"patient_eamil" => $inserDatas['cusemail'],
				"patient_gender" =>$inserDatas['cusgender'] ,
				"patient_full_add" => $inserDatas['full_address'],
				"patient_pincodeid" => $this->getPinIDByByPinCode($inserDatas['chkout_user_pin']),
				"patient_locality" => $inserDatas['address_locality'],
				"patient_city" => $inserDatas['address_city'],
				"patient_state_id" => $this->getStatesIDByStateName($inserDatas['chkout_user_state']),
				"patient_landmark" => $inserDatas['address_landmark'],
				"patient_alternate_phone" => $inserDatas['add_alternate_phone'],
				"is_delivered" => "N"
			];

			$order_master_ins = $this->db->insert('test_order_master', $order_master);
			$order_master_id =  $this->db->insert_id();

			// order detail insert
			$insert_into_detail = $this->insertIntoOrderDetails($inserDatas,$order_master_id);
			

			/*
			// IF TEST DONE FOR OTHERS
			$address_details_other = [];
			if($inserDatas['testForMode']=="OTHER")
			{
				$address_details_other = 
				[
					"customer_id" => $customer_id,
					"order_master_id" => $order_master_id,
					"name" => $inserDatas['address_info_name'],
					"contact" => $inserDatas['address_info_phone'],
					"pincode_id" =>  $this->getPinIDByByPinCode($inserDatas['chkout_user_pin']),
					"locality" => $inserDatas['address_locality'],
					"address" => $inserDatas['full_address'],
					"city" => $inserDatas['address_city'],
					"state_id" => $this->getStatesIDByStateName($inserDatas['chkout_user_state']),
					"landmark" => $inserDatas['address_landmark'],
					"alternate_phone" => $inserDatas['add_alternate_phone']
				];

				$order_master_ins = $this->db->insert('order_address_detail_others', $address_details_other);
			}
			*/
			
			//$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		
			if($this->db->trans_status() === FALSE) 
				{
		            $this->db->trans_rollback();
		            return false;
		        } 
			else 
				{
					$this->db->trans_commit();
					return $uniq_order_id;
		           // return true;
		        }
	        }
			catch (Exception $err) 
			{
	            echo $err->getTraceAsString();
	        }	
   }
  
   	private function getUniqOrderID($custid){
		$uniq_order_id = "";
		$uniq_order_id = time().date("m").$custid;
		return $uniq_order_id;
	}

   private function insertIntoOrderDetails($order_details,$order_master_id)
   {

   		//pre($order_details);

   		
   		$count = sizeof($order_details['iCode']);
		   $order_details_arry = [];
		   $total_test_amt = 0;
		   $test_dtl_amount = 0;
   		for($d=0;$d<$count;$d++)
   		{
			$test_dtl_amount = $this->getPriceDetailForOrders($order_details['hdncenterid'],$order_details['iCode'][$d]);

			if($order_details['deliveryDate'][$d]!=""){
				$order_details['deliveryDate'][$d] = str_replace('/', '-', $order_details['deliveryDate'][$d]);
				$order_details['deliveryDate'][$d] = date("Y-m-d",strtotime($order_details['deliveryDate'][$d]));
			 }
			 else{
				 $order_details['deliveryDate'][$d] = NULL;
			 }


   			$order_details_arry = 
   			[
   				"order_master_id" => $order_master_id,
   				"test_code" => $order_details['iCode'][$d],
   				"delivery_date" => $order_details['deliveryDate'][$d],
   				"center_id" => $order_details['hdncenterid'],
				"test_amount" => $this->getPriceDetailForOrders($order_details['hdncenterid'],$order_details['iCode'][$d]),

			];
			$order_detail_ins = $this->db->insert('test_order_detail', $order_details_arry);
			$total_test_amt+=$test_dtl_amount;
		   }
		   
		   $upd = [
			   "test_order_master.order_total_amt" => $total_test_amt
		   ];
		   $this->db->where("test_order_master.id",$order_master_id);
	       $this->db->update('test_order_master',$upd);

   }

   private function getCustomerExistingData($mobile)
   {
   		$customer_id=0;
   		$where_ary = [
   			"customer_master.phone" =>$mobile
   		];
   		$this->db->select("*")
   				->from("customer_master")
   				->where($where_ary)
   				->limit(1);

   		$query = $this->db->get();
   		if($query->num_rows()> 0)
		{
        	$customer_data = $query->row();  
        	$customer_id = $customer_data->customer_id;
		}
		return $customer_id;
	}



	public function generateCustomerUniqID($considered_for,$tag)
	{
		$data = [];
		$uniq_id = "";
		$lastnumber =0;

		$where_ary = [
			"serial_master.considered_for" => $considered_for
		];
		
		$this->db->select("*")
   				->from("serial_master")
   				->where($where_ary)
   				->limit(1);
   		$query = $this->db->get();
	

		if($query->num_rows()> 0)
		{
			$row = $query->row();  
        	$lastnumber = $row->serial_no;
        	$digit = (int)(log($lastnumber,10)+1) ;
        	if($digit==5)
        	{
        		$uniq_id = $tag.$lastnumber;
        	}
        	else if($digit==4)
        	{
        		$uniq_id = $tag."0".$lastnumber;
        	}
        	else if($digit==3)
        	{
        		$uniq_id = $tag."00".$lastnumber;
        	}
        	else if($digit==2)
        	{
        		$uniq_id = $tag."000".$lastnumber;
        	}
        	else if($digit==1)
        	{
        		$uniq_id = $tag."0000".$lastnumber;
        	}
        	else
        	{
        		$uniq_id = $tag."00000".$lastnumber;
        	}
        	
		}

		
		$data = [
			"uniqno" => $uniq_id,
			"nextserial" => $lastnumber+1
		];
		
    	return $data;
        
	}

	public function updateSerialNumber($updserial,$updfor)
	{
		try{
            $this->db->trans_begin();
			
			$data = ["serial_no" => $updserial];
			$this->db->where("serial_master.considered_for",$updfor);
	        $this->db->update('serial_master',$data);
			
			if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
               
            }
        }
        catch (Exception $err) {
       		echo $err->getTraceAsString();
        }
	}



	private function getPriceDetailForOrders($centerid,$testscode)
	{	
		
			$test_amount = 0;
			$where = [
					"investigations_master.center_id" => $centerid,
					"investigations_master.code" => $testscode
					 ];

			$this->db->select("*")
				->from('investigations_master')
				->where($where);

			$query = $this->db->get();
			if($query->num_rows()> 0)
			{
				$actual_price = 0;
				$discount_rate = 0;
				$discount_amt = 0;
				$aftre_disc_price = 0;

				$total_actual_price = 0;
				$total_disc_price = 0;
				$aftre_disc_price_total = 0;
				$saved_percentg=0;

	            foreach ($query->result() as $rows)
				{
					$discount = $this->getTestDiscountsRate($centerid,$rows->id);
					$discount_amt = $rows->rate*$discount/100;
					$aftre_disc_price = $rows->rate - $discount_amt;

					$total_actual_price+=$rows->rate;
					$aftre_disc_price_total+=$aftre_disc_price;
					$total_disc_price+=$discount_amt;
	            }
	        	
	        	$test_amount = $aftre_disc_price_total;
	        }

	     	return $test_amount;
		
		
	}

	public function getStatesIDByStateName($statename)
    {
    	$state_id =0;
    	$where = [
    		"name" => $statename
    	];
        $single_record =  $this->commondatamodel->getSingleRowByWhereCls('states',$where);
        if(count($single_record)> 0)
		{
			 $state_id = $single_record->id;
		}
		return $state_id;
    }

   public function getPinIDByByPinCode($pincode)
    {
    	$pincode_id =0;
    	$where = [
    		"pincode" => $pincode
    	];
        $single_record =  $this->commondatamodel->getSingleRowByWhereCls('pincode_master',$where);
        if(count($single_record)> 0)
		{
			 $pincode_id = $single_record->id;
		}
		return $pincode_id;
    }


	public function getOrderInvoiceByUnqOrderID($uniqorderID){
		$invoice_data_array = [];
		$whereAry = [
			"test_order_master.uniq_order_id"=>$uniqorderID
		];
		$this->db->select('test_order_master.`id` AS orderID,
						test_order_master.`customer_id`,
						test_order_master.`date_of_test`,
						test_order_master.`delivery_mode`,
						test_order_master.`orderd_on`,
						test_order_master.`uniq_order_id`,
						test_order_master.`order_total_amt`,
						test_order_master.`test_done_for`,
						center_master.`center_name`,
						center_master.`center_full_add`,
						center_master.`contact_no`,
						center_master.`contact_person`,
						center_master.`center_email`,
						center_master.`nearest_landmark`,
						pincode_master.pincode')
				->from('test_order_master')
				->join('center_master','center_master.id = test_order_master.center_master_id','INNER')
				->join('pincode_master','pincode_master.id = center_master.pincode_id','INNER')
				->where($whereAry);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
           
			$order_master_data = $query->row(); 
			//$ret = $query->row(); 
			$invoice_data_array = [
					"order_master" => $order_master_data,
					"order_detail_data" => $this->getOrderDetailData($order_master_data->orderID,$order_master_data->date_of_test),
					"delivery_info" => $this->getDeliverAddressInfo($order_master_data->customer_id,$order_master_data->test_done_for,$uniqorderID)
					
				];
		}
		return $invoice_data_array;
	}

	private function getDeliverAddressInfo($customer_id,$test_for,$uniqorderID){
		$addressdetails = [];
	
				$whereAry = [
					"test_order_master.customer_id"=>$customer_id,
					"test_order_master.uniq_order_id"=>$uniqorderID
				];

				$this->db->select("test_order_master.`test_done_for`,
							test_order_master.`patient_name` AS customerName,
							test_order_master.`patient_contact` AS phone,
							test_order_master.patient_alternate_phone AS alternate_phone,
							test_order_master.patient_locality AS `locality`,
							test_order_master.`patient_full_add` AS fullAddress,
							test_order_master.`patient_city` AS cusCity,
							test_order_master.patient_landmark AS `landamrk`,
							pincode_master.`pincode` AS cusPincode,
							states.`name` AS stateName,
							countries.`name` AS countryName,
							countries.`sortname` AS countryShortName")
					->from('test_order_master')
					//->join('customer_master','customer_master.customer_id = test_order_master.customer_id','INNER')
					->join('pincode_master','pincode_master.id = test_order_master.patient_pincodeid','INNER')
					->join('states','states.id = test_order_master.patient_state_id','INNER')
					->join('countries','countries.id = states.country_id','INNER')
					->where($whereAry);
		$query = $this->db->get();
		
		//echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
           $addressdetails = $query->row();  
		}

		return $addressdetails;

	}

	private function getOrderDetailData($order_master_id,$testdt){
		$whereAry = [
			"test_order_detail.order_master_id"=>$order_master_id

		];
		$this->db->select('test_order_detail.id AS orderDtlID,
						test_order_detail.`order_master_id`,
						test_order_detail.`test_code`,
						test_order_detail.`center_id`,
						test_order_detail.`actual_amount`,
						test_order_detail.`discount_amt`,
						test_order_detail.`test_amount`,
						investigations_master.`id` AS investigationID,
						investigations_master.`name` AS investigationName,
						investigations_master.`rate` AS investigationRate,
						investigations_master.`deliver_in_days`')
				->from('test_order_detail')
				->join('investigations_master','test_order_detail.test_code = investigations_master.code AND investigations_master.center_id = test_order_detail.center_id','INNER')
				->where($whereAry);
		
				$query = $this->db->get();
			//	echo $this->db->last_query();
				if($query->num_rows()> 0)
				{
					foreach ($query->result() as $rows)
					{
						
						$detailData[] = [
							"order_detail_row" => $rows,
							"testdate"=>$testdt,
							"deliveryDate" => $this->getDeliveryDate($rows->deliver_in_days,$testdt)
						];
						
					}
					return $detailData;
				}
				else
				{
					return $detailData;
				}
		
				

	}

}
?>