<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserFunctionsModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
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
	function add_function($postdata,$user_id) {

			$res = $this->db->query("select function_allot_id from functions_allot where title=".$this->db->escape($postdata['title'])." and user_id = '".$user_id."'");
			$result = $res->row();
        	if (!$result) {
				$query = $this->db->query("insert into functions_allot set title=".$this->db->escape($postdata['title']).", image = ".$this->db->escape($postdata['image']).", status = ".$this->db->escape($postdata['status']).", function_id = '".decrypt($postdata['function_id'])."', user_id = '".$user_id."'");	
				return 1;
			}
			else
				return 0;
    }
	function edit_function($postdata,$user_id) {
	$st = '';
	if($postdata['image']!='')
		$st = " , image = ".$this->db->escape($postdata['image'])."";

				$query = $this->db->query("update functions_allot set title=".$this->db->escape($postdata['title']).", status = ".$this->db->escape($postdata['status'])." $st where function_allot_id = '".decrypt($postdata['function_allot_id'])."'");	
				return 1;
			
    }

}	
