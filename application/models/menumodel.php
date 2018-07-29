<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menumodel extends CI_Model{
	public function getAllAdministrativeMenu($table)
	{
		$data = array();
		$where_Ary = array(
			"administartor_menu_master.is_parent" => "P",
			"administartor_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('administartor_menu_master.menu_srl','ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		   {
			  foreach($query->result() as $rows)
			  {
					$data[] = array(
							"FirstLevelMenuData" => $rows,
							"secondLevelMenu" => $this->getSecondLevelMenu($rows->adm_menu_id,$table) 
						 );
			 }
		   }
		   return $data;
	}
	
	public function getSecondLevelMenu($parentID,$table)
	{
		$data = array();
		$where_Ary = array(
			"administartor_menu_master.parent_id" => $parentID,
			"administartor_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('administartor_menu_master.menu_srl','ASC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) 
		   {
				foreach($query->result() as $rows)
				{
					$data[] = array(
							"secondLevelMenuData" => $rows,
							"thirdLevelMenu" => $this->getThirdLevelMenu($rows->adm_menu_id,$table) 
						 );
				}
		   }
		   return $data;
	}
	
	public function getThirdLevelMenu($parentID,$table)
	{
		$data = array();
		$where_Ary = array(
			"administartor_menu_master.parent_id" => $parentID,
			"administartor_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('administartor_menu_master.menu_srl','ASC');
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{
			foreach($query->result() as $rows)
			{
				$data[] = array(
						"thirdLevelMenuData" =>$rows,
					);
			}
		}
		   return $data;
	}
	
	
	public function getSiteMapMenuByTitle($menuTitle)
	{
		$data = array();
		$sql = "SELECT * FROM administartor_menu_master WHERE administartor_menu_master.`menu_title`='".$menuTitle."' AND administartor_menu_master.`is_parent`='P'";
		
		$query = $this->db->query($sql);
		   if ($query->num_rows() > 0) 
		   {
			  foreach($query->result() as $rows)
			  {
						$data[] = array(
							"first_menu_id" => $rows->id,
							"menu_name" => $rows->menu_name,
							"menu_link" => $rows->menu_link,
							"is_parent" => $rows->is_parent,
							"parent_id" => $rows->parent_id,
							"is_new" => $rows->is_new,
							"secondLevelMenu" => $this->getSecondLevelMenu($rows->id) 
						 );
					
                
				}
		   }
		   return $data;
	}
	
	
	
	
	
	
}
?>