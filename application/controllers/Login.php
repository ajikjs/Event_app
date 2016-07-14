<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('LoginModel');
		$this->load->helper('encryption');
    }

	
	public function login_new($page='')
	{
		$this->load->helper('url');
		if(isset($_SESSION['userid']))
		{
			redirect('event_app/home');
		}		
		else	
		{	
			$data['title'] = 'Event App Home Page';
			$data['page'] = $page;
			$this->load->view('home/login', $data);
		}
	}
	public function authenticate($page='') {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = $this->LoginModel->user_authenticate($username, $password);
        if ($data['numrows'] > 0) {
            $_SESSION['loggedin'] = 'true';
            $_SESSION['userid'] = $data['userid'];
			$_SESSION['user_id'] = $data['user_id'];
			$_SESSION['user_type'] = $data['user_type'];
            $_SESSION['user_name'] = $data['username'];
				if($page!='')
				{
					redirect(decrypt($page));
				}
				else
				{
				if($data['user_type'] == 1 && $data['approve']==1)
					redirect('event_app/home_admin');
				else if($data['user_type'] == 2 && $data['approve']==1)
					redirect('event_app/home_user');	
		    	} 
		}
		else {
           redirect('login/log_false');
        }	
    }
	public function log_false() {
		$data['error'] = "User name and Password Doesn't Match";
		$data['title'] = "Event App";
		$this->load->view('home/login', $data);
    }
	
	public function logout() {
        session_destroy();
		redirect('event_app/home/');
    }
}
