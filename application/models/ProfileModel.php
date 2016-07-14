<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProfileModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

   function update_my_profile($postdata) {
		if(($postdata['password'])!=""){
		$tbl1Values = array(
            
            'name' => $postdata['name'],           
            'email' => $postdata['email'],
			'user_name' => $postdata['user_name'],
            'password' => $postdata['password'],
			'phone' => $postdata['phone_no'],
			
        );
		} else {
		
		$tbl1Values = array(
            
            'name' => $postdata['name'],          
            'email' => $postdata['email'],
			'user_name' => $postdata['user_name'],
			'phone' => $postdata['phone_no'],
			
        );
		
		}
		
        $this->db->where('user_id', $_SESSION['userid']);
        $this->db->update('users', $tbl1Values);
       
    }

    
	
	
	   

  

	

	
                 
}	