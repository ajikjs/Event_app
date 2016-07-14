<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_functions extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('UserFunctionsModel');
		$this->load->model('mastermodel');
		$this->load->helper('encryption');
    }

	
	public function sfunction($function_allot_id='') {
		$postdata = $this->mastermodel->get_post_values();
		$function_allot_id = (isset($function_allot_id) && $function_allot_id!='')?decrypt($function_allot_id):'';
		if($function_allot_id == '')
			$function_allot_id = isset($postdata['function_allot_id'])?decrypt($postdata['function_allot_id']):'';
			
		if(!isset($_SESSION['userid']) || $function_allot_id == '' || $_SESSION['userid']!=2)
			{
				redirect('event_app/home_user');
			}
		
		$data['msg'] = '';
			if(isset($postdata['title']) && $postdata['title'] !='')
			{
				/****file upload****/
				if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
				$file_name = $this->mastermodel->generateRandomString();
				$uploaded_file = pathinfo($_FILES["image"]["name"]);
				$extension = $uploaded_file['extension'];
				$image_file = $file_name.'_'.$_FILES['image']['name'];

				
					$_FILES['image']['name'] = $image_file;

					if (!is_file("./uploads/function_images/" . $_FILES["image"]["name"])) {
						move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/function_images/" . $_FILES["image"]["name"]);
						$postdata['image'] = $_FILES["image"]["name"];
					} else {
						$postdata['image'] = '';
					}
				} else {
					$postdata['image'] = "";
				}
				/*********/
				
				$result = $this->UserFunctionsModel->edit_function($postdata,$_SESSION['userid']);
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
			/**functions for menu**/
			$functions = $this->UserFunctionsModel->get_my_functions($_SESSION['userid']);
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
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['function_allot_id'] = $function_allot_id;
		$data['function'] = $this->mastermodel->get_data_srow('functions_allot',$function_allot_id,'function_allot_id');
		if(empty($data['function']))
			redirect('event_app/home_user');
		else
			$this->load->view('user/functions/function', $data);
    }
	
	public function add_function($function_id='')
	{
			if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=2)
			{
				redirect('event_app/my_home');
			}
			$postdata = $this->mastermodel->get_post_values();
			$data['msg'] = '';
			if($function_id == '')
			$function_id = isset($postdata['function_id'])?($postdata['function_id']):'';
			/**functions for menu**/
			$functions = $this->UserFunctionsModel->get_my_functions($_SESSION['userid']);
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
			if(isset($postdata['title']) && $postdata['title'] !='')
			{
				/****file upload****/
				if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
				$file_name = $this->mastermodel->generateRandomString();
				$uploaded_file = pathinfo($_FILES["image"]["name"]);
				$extension = $uploaded_file['extension'];
				$image_file = $file_name.'_'.$_FILES['image']['name'];

				
					$_FILES['image']['name'] = $image_file;

					if (!is_file("./uploads/function_images/" . $_FILES["image"]["name"])) {
						move_uploaded_file($_FILES["image"]["tmp_name"], "./uploads/function_images/" . $_FILES["image"]["name"]);
						$postdata['image'] = $_FILES["image"]["name"];
					} else {
						$postdata['image'] = '';
					}
				} else {
					$postdata['image'] = "";
				}
				/*********/
				$result = $this->UserFunctionsModel->add_function($postdata,$_SESSION['userid']);
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
			$data['function_id']  = $function_id;
			$this->load->view('user/functions/add_function', $data);
	}
	
	public function delete_function($id,$function_id) {
		if(isset($_SESSION['userid']) && $_SESSION['user_type']==2)
		{
        $this->mastermodel->deletedata('functions_allot', decrypt($id), 'function_allot_id');
		$msg= 'DS';
		redirect('user_functions/list_functions/'.$function_id.'/1'.$msg);
		}
		else
		redirect('event_app/home');
            
		
    }

	public function list_functions($function_id,$page='',$msg='') {
		if(!isset($_SESSION['userid']) || $_SESSION['user_type']!=2 )
			{
				redirect('event_app/my_home');
			}
		if($msg !='' && $msg == 'DS')
			$data['msg'] = 'Functions Deleted Successfully';
		/**functions for menu**/
		$functions = $this->UserFunctionsModel->get_my_functions($_SESSION['userid']);
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
		$data['function_details'] = $this->mastermodel->get_data_srow("functions", $function_id,'function_id',true);//get function details
		$data['user_name'] = $_SESSION['user_name'];
		$data['title'] = "Functions";
		$data['contents'] = $this->UserFunctionsModel->select_user_functions($page,$_SESSION['userid'],$function_id);
		$data['functions'] = $data['contents']['content'];
		$data['pagination'] = $data['contents']['pagination'];
		$data['offset'] = $data['contents']['offset'];
		$data['function_id'] = encrypt($function_id);
		$this->load->view('user/functions/list_functions', $data);
    }
	
}
