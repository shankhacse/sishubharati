<?php


if(!function_exists('pre'))
{
	
	function pre($printarry){
		$CI =& get_instance();
		echo "<pre>";
		print_r($printarry);
		echo "</pre>";
	}
}


if(!function_exists('q'))
{
	
	function q(){
		$CI =& get_instance();
        $CI->load->database();
        echo $CI->db->last_query();
	}
}
