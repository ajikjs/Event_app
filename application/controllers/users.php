<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	    function __construct() {
        parent::__construct();
        session_start();

        $this->load->model('UsersModel');
		$this->load->model('mastermodel');
    }

	public function list_users($currentpage='') {
		if(!isset($_SESSION['userid']) && $_SESSION['userid']!=1 )
			{
				redirect('vaccination/home');
			}
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Vaccination";
		$data['details'] = $this->UsersModel->get_all_users($currentpage);
		$data['users'] = $data['details']['content'];
		$data['pagination'] = $data['details']['pagination'];
		$this->load->view('list_users', $data);
    }
	
	public function add_user()
	{
			if(isset($_SESSION['userid']) && $_SESSION['user_type']==2)
			{		
			$postdata = $this->mastermodel->get_post_values();
			$data['msg'] = '';
			if(isset($postdata['name']) && $postdata['name'] !='')
			{
				
				$result = $this->UsersModel->add_user($postdata,$_SESSION['userid']);
				$data['msg'] = 'user added';
			}	
			$data['user_name'] = $_SESSION['user_name'];
			$data['title'] = 'Vaccination';
			$this->load->view('add_user', $data);
			}
			else
				redirect('vaccination/home');
	}
	
	public function list_my_users($currentpage='') {
		if(!isset($_SESSION['userid']) && $_SESSION['use_type']!=2 )
			{
				redirect('vaccination/home');
			}
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Vaccination";
		$data['details'] = $this->UsersModel->get_my_users($_SESSION['userid'],$currentpage);
		$data['users'] = $data['details']['content'];
		$data['pagination'] = $data['details']['pagination'];
		$this->load->view('list_users', $data);
    }
	
	public function user($user_id='') {
		$postdata = $this->mastermodel->get_post_values();
		$user_id = (isset($user_id) && $user_id!='')?$user_id:'';
		if($user_id == '')
			$user_id = isset($postdata['user_id'])?$postdata['user_id']:'';
			
		if(!isset($_SESSION['userid']) || $user_id == '' || $_SESSION['user_type']==3)
			{
				redirect('vaccination/home');
			}
		
		$data['msg'] = '';
			if(isset($postdata['name']) && $postdata['name'] !='')
			{
				
				$result = $this->UsersModel->edit_user($postdata,$user_id);
				$data['msg'] = 'Post Edited';
			}	
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Vaccination";
		$data['user'] = $this->mastermodel->get_data_srow('users',$user_id,'user_id');
		$this->load->view('user', $data);
    }
	
	public function delete_user($id) {

        $this->mastermodel->deletedata('users', $id, 'user_id');
		if($_SESSION['user_type'] == 2)
            redirect('users/list_my_users');
		else	
			redirect('users/list_users');
		
    }
	
}
