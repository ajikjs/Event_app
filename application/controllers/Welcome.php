<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
        parent::__construct();
       // $this->load->model('mastermodel');
    } 
	public function index()
	{
		$this->load->helper('url');
		if (isset($_SESSION['userid']))
			{
				$data['user_name'] = $_SESSION['user_name'];
			}
		
			$data['title'] = 'Upaasana';
			//print_r($data['lvideos']); die;
			$this->load->view('home/home', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
