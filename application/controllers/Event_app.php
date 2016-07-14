<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_App extends CI_Controller {

	    function __construct() {
        parent::__construct();
		$this->load->helper('encryption');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function home()
	{ 
			$page = (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:'';
			$part = explode('index.php',$page);
			echo $page = isset($part[1])?encrypt($part[1]) : '';
			if (isset($_SESSION['userid']))
			{
				$data['user_name'] = $_SESSION['user_name'];
			}
			$data['title'] = 'Event App';
			if($page!='')	
				redirect('login/login_new/'.$page);
			else
				$this->load->view('home/home', $data);
	}
	
	
	public function my_home()
	{
			if(!isset($_SESSION['userid']))
			{
				redirect('event_app/home');
			}
			if($_SESSION['user_type'] == 1)
				redirect('event_app/home_admin');
			else if($_SESSION['user_type'] == 2)
				redirect('event_app/home_user');	
			else 
				redirect('event_app/home');
	}
	
	
	
	public function home_admin()
	{
			if(!isset($_SESSION['userid']) || $_SESSION['user_type'] != 1)
			{
				redirect('event_app/my_home');
			}
			$data['user_name'] = $_SESSION['user_name'];
			$data['title'] = 'Event App';
			$this->load->view('admin/common/home_admin', $data);
	}
	
	public function home_user()
	{
			$this->load->model('FunctionsModel');
			$this->load->model('mastermodel');
			if(!isset($_SESSION['userid']) || $_SESSION['user_type'] != 2)
			{
				redirect('event_app/my_home');
			}
			$fuctions = $this->FunctionsModel->get_my_functions($_SESSION['userid']);
			$data['myfunctions'] = array();
			if(!empty($fuctions))
			{
				$funs = explode(',',$fuctions->function_ids);
				foreach($funs as $fn)
				{
					if($fn !='')
						$data['myfunctions'][] = $this->mastermodel->get_data_srow('functions',$fn,'function_id','true');
				}
			}
			$data['user_name'] = $_SESSION['user_name'];
			$data['title'] = 'event_app';
			
			$this->load->view('user/common/home_user', $data);
	}
	public function logout() {
        session_destroy();
		redirect('event_app/home/');
    }
	
	
	
}
