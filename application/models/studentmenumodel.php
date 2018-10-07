<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class studentmenumodel extends CI_Model{
	public function getAllAdministrativeMenu($table)
	{
		$data = array();
		$where_Ary = array(
			"student_menu_master.is_parent" => "P",
			"student_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('student_menu_master.menu_srl','ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		   {
			  foreach($query->result() as $rows)
			  {
					$data[] = array(
							"FirstLevelMenuData" => $rows,
							"secondLevelMenu" => $this->getSecondLevelMenu($rows->std_menu_id,$table) 
						 );
			 }
		   }
		   return $data;
	}
	
	public function getSecondLevelMenu($parentID,$table)
	{
		$data = array();
		$where_Ary = array(
			"student_menu_master.parent_id" => $parentID,
			"student_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('student_menu_master.menu_srl','ASC');
		$query = $this->db->get();
		
		if($query->num_rows() > 0) 
		   {
				foreach($query->result() as $rows)
				{
					$data[] = array(
							"secondLevelMenuData" => $rows,
							"thirdLevelMenu" => $this->getThirdLevelMenu($rows->std_menu_id,$table) 
						 );
				}
		   }
		   return $data;
	}
	
	public function getThirdLevelMenu($parentID,$table)
	{
		$data = array();
		$where_Ary = array(
			"student_menu_master.parent_id" => $parentID,
			"student_menu_master.is_active" => "Y"
		);
		
		$this->db->select("*")
				->from($table)
				->where($where_Ary)
				->order_by('student_menu_master.menu_srl','ASC');
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
		$sql = "SELECT * FROM student_menu_master WHERE student_menu_master.`menu_title`='".$menuTitle."' AND student_menu_master.`is_parent`='P'";
		
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
	
	
	public function getSessionYearData(){
		$session = $this->session->userdata('user_data');
			$data = [];
			$where = array('session_year.session_id' =>$session['yid']);
			$query = $this->db->select("*")
					->from('session_year')
					->where($where)
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
	
	
	
}
?>