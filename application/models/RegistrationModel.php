<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RegistrationModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /* Common function starts here */

	function get_post_values() {
        $data = array();
        foreach ($_POST as $key => $value) {
            if ($key != "submit") {
                $data[$key] = $this->input->post($key);
            }
        }
        return $data;
    }
	
	function user_exist($email)
	{
		$query = $this->db->query("select * from user where email='$email'");
        $data['numrows'] = $query->num_rows();
        if ($query->num_rows() > 0) {
		return 1;
		}
		else
		return 0;
	}

	function add_StudentRegistration($postdata)
    {  
		$tbl1Values = array(
            
            'name' => $postdata['name'],         
            'email' => $postdata['email'],
			'user_name' => $postdata['user_name'],
            'password' => $postdata['password'],
            'current_job' => $postdata['current_job'],
			'phone_no' => $postdata['phone_no'],
			
        );
        $this->db->insert('user', $tbl1Values);
        
        if ($this->db->trans_status() === FALSE) {
            $data['msg'] = 'Error On adding Registration Details';
            $this->db->trans_rollback();
            return 0;
        } else {
            $data['msg'] = 'Registration  Completed  Successfully  ! Please Login';
            $this->db->trans_commit();
            $data['res'] = 1;
            return $data;
        }  
    }
	
	   

  

	

	
                 
}	