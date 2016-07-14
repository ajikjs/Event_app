<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FunctionsModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

    
	
	function edit_function($postdata,$function_id) {

            $query = $this->db->query("update functions set function_name=".$this->db->escape($postdata['name'])." , description = ".$this->db->escape($postdata['description']).", status = ".$this->db->escape($postdata['status']).", category = ".$this->db->escape($postdata['category'])." where function_id='$function_id'");	
			return 1;
			
    }
	
	function add_function($postdata) {

			$res = $this->db->query("select function_id from functions where function_name=".$this->db->escape($postdata['name']));
			$result = $res->row();
        	if (!$result) {
				$query = $this->db->query("insert into functions set function_name=".$this->db->escape($postdata['name']).", description = ".$this->db->escape($postdata['description']).", status = ".$this->db->escape($postdata['status']).", category = ".$this->db->escape($postdata['category'])."");	
				return 1;
			}
			else
				return 0;
    }

	function select_functions($currentpage=1)
	{
			$content=array();
			//$query = $this->db->query("SELECT * FROM functions");
			$query = $this->db->get("functions");
			$numrows = $query->num_rows();
			$rowsperpage = rowsperpage;
			$totalpages = ceil($numrows / $rowsperpage);
			$url = '';
			if (isset($currentpage) && is_numeric($currentpage)) {
				 $currentpage = (int) $currentpage;
			} else {
				 $currentpage = 1;
					}
			if ($currentpage > $totalpages) {
				$currentpage = $totalpages;
				} 
			if ($currentpage < 1) { 
				$currentpage = 1;
				} 
			$offset = ($currentpage - 1) * $rowsperpage;
			$query = $this->db->query("SELECT * from functions LIMIT $offset, $rowsperpage");
			foreach ($query->result_array() as $row)
						{
						$content[] = $row;
						}
			$range = range;
			$pagination = '<ul class="pagination nomargin pull-right">';

			if ($currentpage > 1) {   
				$pagination.= "<li> <a href='".site_url()."/functions/list_functions/1'><<</a> </li>";   
				$prevpage = $currentpage - 1;   
				$pagination.="<li> <a href='".site_url()."/functions/list_functions/$prevpage'><</a> </li>";
				}  
			for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {   
				if (($x > 0) && ($x <= $totalpages)) {     
					if ($x == $currentpage) {
						$pagination.= " <li class='active'><span class='page-numbers current'>$x</span></li>";
							} else {
							$pagination.= "<li> <a href='".site_url()."/functions/list_functions/$x'>$x</a> </li>";
							} 
					} 
			}      
			if ($currentpage != $totalpages) {
				$nextpage = $currentpage + 1;
				$pagination.= " <li><a href='".site_url()."/functions/list_functions/$nextpage'>></a></li> ";
				$pagination.= " <li><a href='".site_url()."/functions/list_functions/$totalpages'>>></a></li> ";
										
				}

			$pagination.="</ul>";
			$contents['content'] = $content;
			$contents['pagination'] = $pagination;
			$contents['offset'] = $offset;
			return $contents;
	}

	function add_function_allot($postdata) {

			$res = $this->db->query("select user_id from alloted_functions where user_id=".$this->db->escape($postdata['user_id']));
			$result = $res->row();
			$ids = implode(',',$postdata['functions']);
        	if (!$result) {
				$query = $this->db->query("insert into alloted_functions set function_ids=".$this->db->escape($ids).", user_id = ".$this->db->escape($postdata['user_id']));	

			/**insert for no category functions**/
			foreach($postdata['functions'] as $function_id)
			{
				$function = $this->mastermodel->get_data_array("functions", $function_id,'function_id');//get function details
				if($function['category']==0)
				{		

					$res = $this->db->query("select function_allot_id from functions_allot where title=".$this->db->escape($function['function_name'])." and user_id = '".$user_id."'");
				$result = $res->row();
		    	if (!$result) {
					$query = $this->db->query("insert into functions_allot set title=".$this->db->escape($function['function_name']).", image = '', status = '1', function_id = '".$function_id."', user_id = '".$user_id."'");	
				
				}
				}
			}

			/****/
				return 1;
			}
			else
				return 0;
    }
	function select_function_allot($alloted_function_id) {
			$res = $this->db->query("select f.*,u.user_name from alloted_functions f left join users u on(f.user_id=u.user_id) where f.alloted_function_id=".$this->db->escape($alloted_function_id));
			$result = $res->row();
			return $result;
    }
	function select_function_alloted_users()
	{
		$res = $this->db->query("select distinct user_id from alloted_functions");
		foreach ($res->result_array() as $row) {
                $data[] = $row['user_id'];
            }
		
			return $data;	
	}
	function edit_function_allot($postdata) {
			$ids = implode(',',$postdata['functions']);
			$query = $this->db->query("update alloted_functions set function_ids=".$this->db->escape($ids)." where alloted_function_id = ".$postdata['alloted_function_id']);	
			/**insert for no category functions**/
			foreach($postdata['functions'] as $function_id)
			{
				$function = $this->mastermodel->get_data_srow("functions", $function_id,'function_id',true);//get function details
				if($function['category']==0)
				{		

					$res = $this->db->query("select function_allot_id from functions_allot where title=".$this->db->escape($function['function_name'])." and user_id = '".$postdata['user_id']."'");
				$result = $res->row();
		    	if (!$result) {
					$query = $this->db->query("insert into functions_allot set title=".$this->db->escape($function['function_name']).", image = '', status = '1', function_id = '".$function_id."', user_id = '".$postdata['user_id']."'");	
				
				}
				}
			}

			/****/
				return 1;
			
	}
	function get_my_functions($user_id) {
			$res = $this->db->query("select * from alloted_functions where user_id=".$this->db->escape($user_id));
			$result = $res->row();
			return $result;
    }
	function select_user_functions($currentpage=1,$user_id,$function_id) {
			$content=array();
			$query = $this->db->query("SELECT * FROM functions_allot where user_id = '".$user_id."' and function_id='".$function_id."'");
			$numrows = $query->num_rows();
			$rowsperpage = rowsperpage;
			$totalpages = ceil($numrows / $rowsperpage);
			$url = '';
			if (isset($currentpage) && is_numeric($currentpage)) {
				 $currentpage = (int) $currentpage;
			} else {
				 $currentpage = 1;
					}
			if ($currentpage > $totalpages) {
				$currentpage = $totalpages;
				} 
			if ($currentpage < 1) { 
				$currentpage = 1;
				} 
			$offset = ($currentpage - 1) * $rowsperpage;
			$query = $this->db->query("SELECT * from functions_allot where user_id = '".$user_id."' and function_id='".$function_id."' LIMIT $offset, $rowsperpage");
			foreach ($query->result_array() as $row)
						{
						$content[] = $row;
						}
			$range = range;
			$pagination = '<ul class="pagination nomargin pull-right">';

			if ($currentpage > 1) {   
				$pagination.= "<li> <a href='".site_url()."/functions/list_functions/1'><<</a> </li>";   
				$prevpage = $currentpage - 1;   
				$pagination.="<li> <a href='".site_url()."/functions/list_functions/$prevpage'><</a> </li>";
				}  
			for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {   
				if (($x > 0) && ($x <= $totalpages)) {     
					if ($x == $currentpage) {
						$pagination.= " <li class='active'><span class='page-numbers current'>$x</span></li>";
							} else {
							$pagination.= "<li> <a href='".site_url()."/functions/list_functions/$x'>$x</a> </li>";
							} 
					} 
			}      
			if ($currentpage != $totalpages) {
				$nextpage = $currentpage + 1;
				$pagination.= " <li><a href='".site_url()."/functions/list_functions/$nextpage'>></a></li> ";
				$pagination.= " <li><a href='".site_url()."/functions/list_functions/$totalpages'>>></a></li> ";
										
				}

			$pagination.="</ul>";
			$contents['content'] = $content;
			$contents['pagination'] = $pagination;
			$contents['offset'] = $offset;
			return $contents;
    }

}	
