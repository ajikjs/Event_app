<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UsersModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

    
	function get_all_users($currentpage=1) {
		$sq = '';
		$url = '';
		$content = array();
		$query = $this->db->query("SELECT * FROM users");
		$numrows = $query->num_rows();
		$rowsperpage = 20;
		$totalpages = ceil($numrows / $rowsperpage);
		
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
		$query = $this->db->query("SELECT * from users LIMIT $offset, $rowsperpage");
		foreach ($query->result_array() as $row)
					{
					$content[] = $row;
					}
		$range = 3;
		$pagination = '<ul class="pagination nomargin pull-right">';

		if ($currentpage > 1) {   
			$pagination.= "<li> <a href='".site_url."/users/list_users/".$url."/1'><<</a> </li>";   
			$prevpage = $currentpage - 1;   
			$pagination.="<li> <a href='".site_url."/users/list_users/".$url."/$prevpage'><</a> </li>";
			}  
		for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {   
			if (($x > 0) && ($x <= $totalpages)) {     
				if ($x == $currentpage) {
					$pagination.= " <li class='active'><span class='page-numbers current'>$x</span></li>";
						} else {
						$pagination.= "<li> <a href='".site_url."/users/list_users/".$url."/$x'>$x</a> </li>";
						} 
				} 
		}      
		if ($currentpage != $totalpages) {
			$nextpage = $currentpage + 1;
			$pagination.= " <li><a href='".site_url."/users/list_users/".$url."/$nextpage'>></a></li> ";
			$pagination.= " <li><a href='".site_url."/users/list_users/".$url."/$totalpages'>>></a></li> ";
										
			}

		$pagination.="</ul>";
		$contents['content'] = $content;
		$contents['pagination'] = $pagination;
		$contents['offset'] = $offset;
		return $contents;
    }
	
	function get_my_users($user_id,$currentpage=1) {
		$sq = '';
		$content = array();
		if($user_id!='')
		$sq .= "where hospital_id = '$user_id'";
		$url = '';
		$query = $this->db->query("SELECT * FROM users $sq");
		$numrows = $query->num_rows();
		$rowsperpage = 20;
		$totalpages = ceil($numrows / $rowsperpage);
		
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
		$query = $this->db->query("SELECT * from users $sq LIMIT $offset, $rowsperpage");
		foreach ($query->result_array() as $row)
					{
					$content[] = $row;
					}
		$range = 3;
		$pagination = '<ul class="pagination nomargin pull-right">';

		if ($currentpage > 1) {   
			$pagination.= "<li> <a href='".site_url."/users/list_users/".$url."/1'><<</a> </li>";   
			$prevpage = $currentpage - 1;   
			$pagination.="<li> <a href='".site_url."/users/list_users/".$url."/$prevpage'><</a> </li>";
			}  
		for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {   
			if (($x > 0) && ($x <= $totalpages)) {     
				if ($x == $currentpage) {
					$pagination.= " <li class='active'><span class='page-numbers current'>$x</span></li>";
						} else {
						$pagination.= "<li> <a href='".site_url."/users/list_users/".$url."/$x'>$x</a> </li>";
						} 
				} 
		}      
		if ($currentpage != $totalpages) {
			$nextpage = $currentpage + 1;
			$pagination.= " <li><a href='".site_url."/users/list_users/".$url."/$nextpage'>></a></li> ";
			$pagination.= " <li><a href='".site_url."/users/list_users/".$url."/$totalpages'>>></a></li> ";
										
			}

		$pagination.="</ul>";
		$contents['content'] = $content;
		$contents['pagination'] = $pagination;
		$contents['offset'] = $offset;
		return $contents;
    }
	
	function edit_user($postdata,$user_id) {
	
            $query = $this->db->query("update users set name='".mysql_real_escape_string($postdata['name'])."', address='".mysql_real_escape_string($postdata['address'])."', email='".mysql_real_escape_string($postdata['email'])."', phone= '".mysql_real_escape_string($postdata['phone'])."' where user_id='$user_id'");	
    }
	
	function add_user($postdata,$user_id) {
	
            $query = $this->db->query("insert into users set name='".mysql_real_escape_string($postdata['name'])."', user_name='".mysql_real_escape_string($postdata['user_name'])."', password='".mysql_real_escape_string($postdata['password'])."',address='".mysql_real_escape_string($postdata['address'])."', email='".mysql_real_escape_string($postdata['email'])."', approve='1', user_type='3', phone= '".mysql_real_escape_string($postdata['phone'])."', hospital_id='$user_id'");	
    }



	
	
	   

  

	

	
                 
}	