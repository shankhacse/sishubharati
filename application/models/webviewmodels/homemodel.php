<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class homemodel extends CI_Model{

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

	

	public function repopulateInvestigationByPinAndCode($pincode,$notinval)
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
					WHERE pincode_master.`pincode`='".$pincode."'
					AND investigations_master.`code` NOT IN ('".$notinval."')
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
}
?>