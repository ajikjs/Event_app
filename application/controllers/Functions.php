<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class functions extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('functionsModel');
		$this->load->model('mastermodel');
		$this->load->helper('encryption');
    }

	
	public function list_functions($page='',$msg='') {
		if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=1 )
			{
				redirect('event_app/my_home');
			}
		if($msg !='' && $msg == 'DS')
			$data['msg'] = 'Functions Deleted Successfully';
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['contents'] = $this->functionsModel->select_functions($page);
		$data['functions'] = $data['contents']['content'];
		$data['pagination'] = $data['contents']['pagination'];
		$data['offset'] = $data['contents']['offset'];
		$this->load->view('admin/functions/list_functions', $data);
    }
	
	public function sfunction($function_id='') {
		$postdata = $this->mastermodel->get_post_values();
		$function_id = (isset($function_id) && $function_id!='')?decrypt($function_id):'';
		if($function_id == '')
			$function_id = isset($postdata['function_id'])?$postdata['function_id']:'';
			
		if(!isset($_SESSION['userid']) || $function_id == '' || $_SESSION['userid']!=1)
			{
				redirect('event_app/home_admin');
			}
		
		$data['msg'] = '';
			if(isset($postdata['name']) && $postdata['name'] !='')
			{
				
				$result = $this->functionsModel->edit_function($postdata,$function_id);
				if($result)
				{
					$data['msg'] = 'Function Edited';
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
		$data['function'] = $this->mastermodel->get_data_srow('functions',$function_id,'function_id');
		if(empty($data['function']))
			redirect('event_app/home_admin');
		else
			$this->load->view('admin/functions/function', $data);
    }
	
	public function add_function()
	{
			if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=1)
			{
				redirect('event_app/my_home');
			}
			$postdata = $this->mastermodel->get_post_values();
			$data['msg'] = '';
			if(isset($postdata['name']) && $postdata['name'] !='')
			{
				
				$result = $this->functionsModel->add_function($postdata);
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
			$data['title'] = 'Functions';
			$this->load->view('admin/functions/add_function', $data);
	}
	
	public function delete_function($id) {
		if(isset($_SESSION['userid']) && $_SESSION['user_type']==1)
		{
        $this->mastermodel->deletedata('functions', decrypt($id), 'function_id');
		$msg= 'DS';
		redirect('functions/list_functions/1/'.$msg);
		}
		else
		redirect('event_app/home');
            
		
    }

	public function list_functions_user($function_id,$page='',$msg='') {
		if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=2 )
			{
				redirect('event_app/my_home');
			}
		if($msg !='' && $msg == 'DS')
			$data['msg'] = 'Functions Deleted Successfully';
		/**functions for menu**/
		$functions = $this->functionsModel->get_my_functions($_SESSION['userid']);
			$data['myfunctions'] = array();
			if(!empty($functions))
			{
				$funs = explode(',',$functions->function_ids);
				foreach($funs as $fn)
				{
					if($fn !='')
						$data['myfunctions'][] = $this->mastermodel->get_data_srow('functions',$fn,'function_id','true');
				}
			}
		/***/
		$function_id = decrypt($function_id);
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['contents'] = $this->functionsModel->select_user_functions($page,$_SESSION['userid'],$function_id);
		$data['functions'] = $data['contents']['content'];
		$data['pagination'] = $data['contents']['pagination'];
		$data['offset'] = $data['contents']['offset'];
		$this->load->view('user/functions/list_functions', $data);
    }
	
}
