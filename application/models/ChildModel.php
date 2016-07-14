<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChildModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

    
	
	function edit_child($postdata,$child_id) {
	
            $query = $this->db->query("update child set status='".mysql_real_escape_string($postdata['status'])."' where child_id='$child_id'");	
    }
	
	function add_child($postdata,$user_id) {
	
            $query = $this->db->query("insert into child set dob='".mysql_real_escape_string($postdata['dob'])."', user_id='".mysql_real_escape_string($user_id)."', status='".mysql_real_escape_string($postdata['status'])."'");	
			return $this->db->insert_id();
	}
	
	function get_periods() {
        $query = $this->db->query("select vaccination_id,period1, period2, period3 from vaccination");
        if ($query->num_rows() > 0) {

				$result = $query->result_array();
			return $result;	
        }
        else         
			return '';	
    }
	
	function get_vaccin_child($child_id) {
        $query = $this->db->query("select n.notification_id,n.period1,n.period2,n.period3,v.vaccination_name,v.vaccination_id,n.status1,n.status2,n.status3 from `notification` n left join vaccination v on (n.vaccination_id = v.vaccination_id)  WHERE child_id=$child_id");
        if ($query->num_rows() > 0) {

				$result = $query->result_array();
			return $result;	
        }
        else         
			return '';	
    }
	
	function add_notification($postdata,$child_id) {
			
			$periods = $this->get_periods();
			foreach($periods as $period)
			{
				if($period['period1'] !='')
				{
				$effectiveDate1 = $postdata['dob'];
				$effectiveDate1 = date("Y-m-d", strtotime($period['period1'], strtotime($effectiveDate1)));
				}
				else
				$effectiveDate1 = '';
				if($period['period2'] !='')
				{
				$effectiveDate2 = $postdata['dob'];
				$effectiveDate2 = date("Y-m-d", strtotime($period['period2'], strtotime($effectiveDate2)));
				}
				else
				$effectiveDate2 = '';
				if($period['period3'] !='')
				{
				$effectiveDate3 = $postdata['dob'];
				$effectiveDate3 = date("Y-m-d", strtotime($period['period3'], strtotime($effectiveDate3)));
				}
				else
				$effectiveDate3 = '';
				$query = $this->db->query("insert into notification set `child_id`='".mysql_real_escape_string($child_id)."', `vaccination_id`='".mysql_real_escape_string($period['vaccination_id'])."', `period1`='".mysql_real_escape_string($effectiveDate1)."', `period2`='".mysql_real_escape_string($effectiveDate2)."', `period3`='".mysql_real_escape_string($effectiveDate3)."'");	
			}
   }
   
   function get_all_child($user_id='',$currentpage=1) {
		$sq = '';
		$content = array();
		if($user_id!='')
		$sq .= "where u.hospital_id = '$user_id'";
		$url = '';
		$query = $this->db->query("SELECT * FROM child c left join users u on (c.user_id=u.user_id) $sq");
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
		$query = $this->db->query("SELECT c.*,u.name from child c left join users u on (c.user_id=u.user_id) $sq LIMIT $offset, $rowsperpage");
		foreach ($query->result_array() as $row)
					{
					$content[] = $row;
					}
		$range = 3;
		$pagination = '<ul class="pagination nomargin pull-right">';

		if ($currentpage > 1) {   
			$pagination.= "<li> <a href='".site_url."/child/list_all_child/".$url."/1'><<</a> </li>";   
			$prevpage = $currentpage - 1;   
			$pagination.="<li> <a href='".site_url."/child/list_all_child/".$url."/$prevpage'><</a> </li>";
			}  
		for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {   
			if (($x > 0) && ($x <= $totalpages)) {     
				if ($x == $currentpage) {
					$pagination.= " <li class='active'><span class='page-numbers current'>$x</span></li>";
						} else {
						$pagination.= "<li> <a href='".site_url."/child/list_all_child/".$url."/$x'>$x</a> </li>";
						} 
				} 
		}      
		if ($currentpage != $totalpages) {
			$nextpage = $currentpage + 1;
			$pagination.= " <li><a href='".site_url."/child/list_all_child/".$url."/$nextpage'>></a></li> ";
			$pagination.= " <li><a href='".site_url."/child/list_all_child/".$url."/$totalpages'>>></a></li> ";
										
			}

		$pagination.="</ul>";
		$contents['content'] = $content;
		$contents['pagination'] = $pagination;
		$contents['offset'] = $offset;
		return $contents;
    }

}	