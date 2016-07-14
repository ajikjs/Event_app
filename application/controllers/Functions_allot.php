<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class functions_allot extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('functionsModel');
		$this->load->model('mastermodel');
		$this->load->helper('encryption');
    }

	
	public function add_functions_allot($msg='') {

		if(!isset($_SESSION['userid']) && $_SESSION['userid']!=1 )
			{
				redirect('event_app/my_home');
			}
		if($msg !='' && $msg == 'DS')
			$data['msg'] = 'Functions Deleted Successfully';
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions Allot";
		$data['functions'] = $this->mastermodel->get_data_array('functions','1','status');
		$data['alloted_users'] = $this->functionsModel->select_function_alloted_users();
		$data['users'] = $this->mastermodel->getdatas('users');
		$this->load->view('admin/function_allot/add_function_allot', $data);
    }

	public function list_functions_allot($msg='') {

		if(!isset($_SESSION['userid']) && $_SESSION['userid']!=1 )
			{
				redirect('event_app/my_home');
			}
		if($msg !='' && $msg == 'DS')
			$data['msg'] = 'Functions Deleted Successfully';
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions Allot";
		$data['users'] = $this->mastermodel->getdatas('users');
		$data['alloted_functions'] = $this->mastermodel->getdatas('alloted_functions');
		$this->load->view('admin/function_allot/list_functions_allot', $data);
    }
	
	public function function_allot($alloted_function_id='') {
		$postdata = $this->mastermodel->get_post_values();
		$alloted_function_id = (isset($alloted_function_id) && $alloted_function_id!='') ? decrypt($alloted_function_id): ''; 
		if($alloted_function_id == '')
			$alloted_function_id = isset($postdata['alloted_function_id'])?$postdata['alloted_function_id']:'';
			
		if(!isset($_SESSION['userid']) || $alloted_function_id == '' || $_SESSION['userid']!=1)
			{
				redirect('event_app/home_admin');
			}
		
		$data['msg'] = '';
			if(isset($postdata['alloted_function_id']) && $postdata['alloted_function_id'] !='')
			{
				
				$result = $this->functionsModel->edit_function_allot($postdata,$alloted_function_id);
				if($result)
				{
					$data['msg'] = 'Functions Modified';
					$data['class'] = 'success';
				}
				else
				{
					$data['msg'] = 'Function already Exists';
					$data['class'] = 'danger';
				}
			}
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['alloted_function'] = $this->functionsModel->select_function_allot($alloted_function_id);
		$data['functions'] = $this->mastermodel->get_data_array('functions','1','status');
		if(empty($data['alloted_function']))
			redirect('event_app/home_admin');
		else
			$this->load->view('admin/function_allot/function_allot', $data);
    }
	
	public function new_allot()
	{
			if(!isset($_SESSION['userid']) || $_SESSION['userid']!=1)
			{
				redirect('event_app/my_home');
			}
			$postdata = $this->mastermodel->get_post_values();
			$data['msg'] = '';
			if(isset($postdata['user_id']) && $postdata['user_id'] !='')
			{
				
				$result = $this->functionsModel->add_function_allot($postdata);
				if($result)
				{
					$data['msg'] = 'Function added';
					$data['class'] = 'success';
				}
				else
				{
					$data['msg'] = 'Function already Exists';
					$data['class'] = 'danger';
				}
			}	
			$data['user_name'] = $_SESSION['user_name'];
			$data['title'] = "Functions Allot";
			$data['users'] = $this->mastermodel->getdatas('users');
			$data['alloted_functions'] = $this->mastermodel->getdatas('alloted_functions');
			$this->load->view('admin/function_allot/list_functions_allot', $data);
	}
	
	public function delete_function($id) {

        $this->mastermodel->deletedata('functions', decrypt($id), 'function_id');
		$msg= 'DS';
            redirect('functions/list_functions/'.$msg);
		
    }
	
}
