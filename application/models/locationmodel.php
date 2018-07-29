<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class locationmodel extends CI_Model{
	
	public function getAllCountry($param)
	{
		$data = [];
		try{
         	   //$procedure = "CALL SP_GetAllCountry('".$param."')";
         	   $procedure = "CALL SP_GetAllCountry(NULL)";
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

	public function getAllStates($countryID,$active)
	{
		$data = [];
		try{
         	  // $procedure = "CALL SP_GetAllState($countryID,'".$active."')";
         	   $procedure = "CALL SP_GetAllState($countryID,NULL)";
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

	public function getAllCities($stateID)
	{
		$data = [];

		try{
         
			
			   $procedure = "CALL SP_GetAllCities($stateID)";
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


	public function getALLDistricts($stateID)
	{
		$data = [];
		try{
         	   $procedure = "CALL SP_GetAllDistrict($stateID)";
			   $query = $this->db->query($procedure);
				#echo $this->db->last_query();
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


	public function getAllAreas()
	{
		$data = [];

		try{
           
		
		$this->db->select("area_master.`id` AS areaID,
					area_master.`area_name`,
					area_master.`is_active`,
					cities.`name` AS cityname,
					cities.`state_id`")
				->from('area_master')
				->join('cities','cities.id = area_master.city_id','INNER')
				->order_by('area_master.area_name');
			
		$query = $this->db->get();

		//echo $this->db->last_query();
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
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}



	public function getAllPinCodes()
	{
		$data = [];

		try{
           
		
		$this->db->select("pincode_master.`id` AS pincodeID,
					pincode_master.`pincode`,
					pincode_master.`is_active`,
					district.`name` AS districtname,
					states.`name` AS statename,
					countries.name AS countryname
					")
				->from('pincode_master')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->order_by('pincode_master.pincode');
			
		$query = $this->db->get();

	//	echo $this->db->last_query();
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
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	public function getAllActivePinCodes()
	{
		$data = [];

		try{
           
		
		$this->db->select("pincode_master.`id` AS pincodeID,
					pincode_master.`pincode`,
					pincode_master.`is_active`,
					district.`name` AS districtname,
					states.`name` AS statename,
					countries.name AS countryname
					")
				->from('pincode_master')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->where('pincode_master.is_active','Y')
				->order_by('pincode_master.pincode');
			
		$query = $this->db->get();

		//echo $this->db->last_query();
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
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	 public function getDistrictByID($where)
	 {
	 	$data = [];
		try
	 	{
			$this->db->select("district.`id` AS distID,
							district.`name` AS districtname,
							district.`is_active` AS distStatus,
							district.`state_id`,
							states.`name` AS statename,
							countries.`id` AS countryID,
							countries.`name` AS countryname")
				->from('district')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->where($where);

			$query = $this->db->get();
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
	 	catch(Exception $err)
	 	{
	 		 echo $err->getTraceAsString();
	 	}


	 }


	 public function getLocationDetailByPin($pincode)
	 {
	 	$where = array(
	 		"pincode_master.pincode" => $pincode,
	 		"pincode_master.is_active" => 'Y'
	 	);
	 	$data = [];
		try
	 	{
			$this->db->select("pincode_master.`id` AS pincodeID,
								pincode_master.pincode,
								district.`name` AS districtname,
								district.`id` AS districtID,
								states.`name` AS statename,
								states.`id` AS stateID,
								countries.`name` AS countryname,
								countries.`id` AS countryID")
				->from('pincode_master')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->where($where);

			$query = $this->db->get();
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
	 	catch(Exception $err)
	 	{
	 		 echo $err->getTraceAsString();
	 	}

	 }
	
	

	
	
}