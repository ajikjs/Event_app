<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('ProfileModel');
		$this->load->model('mastermodel');
		$this->load->helper('url');
    }

	
	public function edit() {
	if (isset($_SESSION['userid']))
		{
			$this->load->model('UserFunctionsModel');
			$this->load->helper('encryption');
			$postdata = $this->mastermodel->get_post_values();
			//$data['msg']='';
			if(!empty($postdata))
			{
			$res = $this->ProfileModel->update_my_profile($postdata);
			}
			/**functions for menu**/
			if($_SESSION['user_type'] == 2)
			{
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
			}
			/***/
			$data['user_name'] = $_SESSION['user_name'];
			$data['title'] = 'Event App';
			$data['user_type'] = $_SESSION['user_type'];
			$data['user'] = $this->mastermodel->get_data_srow('users',$_SESSION['userid'],'user_id');//from user table all value fetch
			$this->load->view('admin/common/edit_profile',$data);
		}
	else	
		{	
			$data['title'] = 'Event App';
			$this->load->view('event_app/home_admin', $data);
		}	
	
	}
	
	
}

