<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NotificationModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

    
	
	
	
	function get_notification_child($userid='') {
	$st='';
	if($userid!='')
		$st .= "WHERE user_id=$userid";
		$query = $this->db->query("select * from `child` $st");	
		$resut_array = array();
		$child = $query->result_array();
		foreach ( $child as $ch )
		{	
			$query = $this->db->query("select v.vaccination_name,n.period1,n.period2,n.period3 from `notification` n
	left join vaccination v on (n.vaccination_id = v.vaccination_id)
	left join child c on (c.child_id = n.child_id)
	WHERE n.child_id='".$ch['child_id']."' and c.status = '1'");	
		
			$notification = $query->result_array();
			foreach($notification as $not)
			{
				$periods = array();
				$periods['period'][]=$not['period1'];
				$periods['period'][]=$not['period2'];
				$periods['period'][]=$not['period3'];
				$i=0;
				foreach($periods['period'] as $period)
				{
					$datetime1 = date_create(date("Y/m/d"));
					$datetime2 = date_create($period);
					$interval1 = date_diff($datetime1, $datetime2);
					$vp= $interval1->format('%R%a');
					if($vp < 7 && $vp > 0)
					{
					$resut_array[$i]['child_id'] = $ch['child_id'];
					$resut_array[$i]['vaccination_name'] = $not['vaccination_name'];
					$resut_array[$i]['date'] = $period;
					$resut_array[$i]['days'] = $vp;
					} 
					$i++;
				} 
			} 
		} 
		return $resut_array;
	}	
	
	function change_status($not_id,$status) {
	
            $query = $this->db->query("update notification set status$status='1' where notification_id='$not_id'");	
    }
	
	function send_mail($child_id) {
			
		
            $query = $this->db->query("select u.email from `child` c left join users u on(c.user_id=u.user_id) where c.child_id='$child_id'");	
			$result = $query->row();
			return $result->email;
   }
		


}	