<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller {

	    function __construct() {
        parent::__construct();

        $this->load->model('RegistrationModel');
		
		 
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://registrationple.com/index.php/welcome
	 *	- or -  
	 * 		http://registrationple.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://registrationple.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	
	function registration_new() { 
			//$this->load->model('registration');
            $postdata = $this->RegistrationModel->get_post_values();
			$data['suc'] = ""; 
			$data['fai'] = ""; 
            if(isset($postdata['email'])) 
			{
				$exist = $this->RegistrationModel->user_exist($postdata['email']);
				//echo $exist;die;
				if($exist == 0)
				{
				$res = $this->RegistrationModel->add_StudentRegistration($postdata);
				$data['suc'] = "Registration  Completed  Successfully  !";
				}
				else
				{
				$data['fai'] = "Email id  Already Exists"; 
				}
			}	
				$data['title'] = 'All4marriage';
				$this->load->view('registration', $data);
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */