<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginModel extends CI_Model {


	function user_authenticate($username, $password) {
        //$passwordmd5 = md5($password);
        $query = $this->db->query("select * from users where user_name=".$this->db->escape($username)." and password=".$this->db->escape($password)."");
        $data['numrows'] = $query->num_rows();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $data['userid'] = $result->user_id;
			$data['user_id'] = $result->user_id;
            $data['username'] = $result->user_name;
			$data['approve'] = $result->approve;
			$data['user_type'] = $result->user_type;

            return $data;
        }
        else
            return 0;
    }



	
	
	   

  

	

	
                 
}	
