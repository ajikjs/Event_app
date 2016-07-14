<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ModuleFieldModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('mastermodel');
    }


	function get_fields()
	{
			$contents = array();
			$query = $this->db->query("SELECT * FROM field_types where status = '1'");
			foreach ($query->result_array() as $row)
						{
						$contents[] = $row;
						}
			return $contents;
	}
	function get_function_fields($function_id)
	{
			$contents = array();
			$query = $this->db->query("SELECT * FROM function_fields where function_id = '".$function_id."'");
			foreach ($query->result_array() as $row)
						{
						$contents[] = $row;
						}
			return $contents;
	}
	function modify_function_fields($postdata,$function_id)
	{
			/***remove unwanted fields****/
			$ids = $this->mastermodel->get_data_array("function_fields", $function_id,'function_id');
			foreach($ids as $id)
			{
				if(!in_array($id['function_field_id'],$postdata['function_field_id']))
				$query = $this->db->query("Delete FROM function_fields where function_field_id = '".$id['function_field_id']."'");
			}/**********/
			$size = sizeof($postdata['name']);
			for($i=0; $i<$size; $i++)
			{
				if(isset($postdata['name'][$i]) && isset($postdata['function_fields'][$i]) && $postdata['name'][$i] !='' && $postdata['function_fields'][$i] !='')
				{
				$status = (isset($postdata['status'][$i]) && $postdata['status'][$i]==1)?$postdata['status'][$i]:0;
				$required = (isset($postdata['required'][$i]) && $postdata['required'][$i]==1)?$postdata['required'][$i]:0;
				if($postdata['function_field_id'][$i]!='')/******update already exist fields*****/
				{
					$this->db->query("update function_fields set function_id = ".$this->db->escape($function_id).", name = ".$this->db->escape($postdata['name'][$i]).", field_type_id = ".$this->db->escape($postdata['function_fields'][$i]).", field_order = ".$this->db->escape($postdata['order'][$i]).", status = ".$this->db->escape($status).", required = ".$this->db->escape($required).", options = ".$this->db->escape($postdata['options'][$i])." where function_field_id = ".$this->db->escape($postdata['function_field_id'][$i])." ");
				}
				else
				{ /******insert new fields*****/
					$this->db->query("Insert into function_fields set function_id = ".$this->db->escape($function_id).", name = ".$this->db->escape($postdata['name'][$i]).", field_type_id = ".$this->db->escape($postdata['function_fields'][$i]).", field_order = ".$this->db->escape($postdata['order'][$i]).", status = ".$this->db->escape($status).", required = ".$this->db->escape($required).", options = ".$this->db->escape($postdata['options'][$i])." ");
				}
				}
			}
			return 1;
	}

}	
