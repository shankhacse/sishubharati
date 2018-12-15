<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class commondatamodel extends CI_Model{
	
	public function insertSingleTableData($table,$data){
		try{
            $this->db->trans_begin();
			
			$this->db->insert($table, $data);
			
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

	/* 
		@insertMultiTableData('name of table array','insert value as array')
		@date 14.11.2017
		@By Mithilesh
	*/
	
	public function insertMultiTableData($tblnameArry,$insertArray){
		try{
            $this->db->trans_begin();
			
			for($i=0;$i<sizeof($insertArray);$i++)
			{
				 $this->db->insert($tblnameArry[$i], $insertArray[$i]);
			}
			
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
	
	
	public function checkExistanceData($table,$where)
	{
		
		$this->db->select('*')
				->from($table)
				->where($where);
		$query = $this->db->get();
	#echo $this->db->last_query();
		if($query->num_rows()>0){
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	
	public function getAllDropdownData($table)
	{
		$data = array();
		$this->db->select("*")
				->from($table);
		$query = $this->db->get();
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
	
	public function getSingleRowByWhereCls($table,$where)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->limit(1);
		$query = $this->db->get();
		
		#echo $this->db->last_query();
		
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
	
	
	public function getAllRecordWhere($table,$where)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
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

	public function getAllRecordWhereOrderBy($table,$where,$orderby)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->order_by($orderby);
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

	public function getAllRecordOrderByLike($table,$likecolumn,$likeStr,$orderby,$ordertag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->like($likecolumn,$likeStr,'after')
				->order_by($orderby,$ordertag);
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


	public function getAllRecordOrderByLikeWhere($table,$where,$likecolumn,$likeStr,$orderby,$ordertag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->where($where)
				->like($likecolumn,$likeStr,'after')
				->order_by($orderby,$ordertag);
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

	public function getAllRecordOrderBy($table,$orderby,$orderTag)
	{
		$data = array();
		$this->db->select("*")
				->from($table)
				->order_by($orderby,$orderTag);
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

	/*
	@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
	*/
	public function updateData_WithUserActivity($upd_tbl_name,$upd_data,$upd_where,$user_actvty_tbl,$user_actvy_data)
	{
		 try {
            $this->db->trans_begin();
			$this->db->where($upd_where);
            $this->db->update($upd_tbl_name,$upd_data);
           
			$this->db->insert($user_actvty_tbl, $user_actvy_data);
			#echo $this->db->last_query();
			
				
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


	/* fetching Data For All type of document from any module
	*  @getDocumentDetailData('where upload_from_module_id,upload_from_module');
	*  On 23.01.2018
	*  By Mithilesh
	*/

	public function getDocumentDetailData($where)
	{

		$data = array();
		$this->db->select("*")
				->from('document_upload_all')
				->join('document_type','document_type.id = document_upload_all.document_type_id','INNER')
				->where($where);
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
	


public function DeleteData($table,$where)
	{
		
		$this->db->where($where);
        
		$query = $this->db->delete($table);
	#echo $this->db->last_query();
		if($query){
			return 1;
		}
		else
		{
			return 0;
		}
		
	}



	public function insertSingleTableDataRerurnInsertId($table,$data){
		
			$this->db->insert($table, $data);
		    $insert_ID = $this->db->insert_id();
            return $insert_ID;
	}



	public function rowcount($table)
	{
		
		$this->db->select('*')
				->from($table);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}

	public function rowcountwhere($table,$where)
	{
		
		$this->db->select('*')
				->from($table)
				->where($where);

		$query = $this->db->get();
		#q();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}
	
	public function updateDataSingleTable($upd_tbl_name,$upd_data,$upd_where)
	{
		 try {
            $this->db->trans_begin();
			$this->db->where($upd_where);
            $this->db->update($upd_tbl_name,$upd_data);
           
			
			#echo $this->db->last_query();
			
				
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
	
	
}